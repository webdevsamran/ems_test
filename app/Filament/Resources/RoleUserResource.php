<?php

namespace App\Filament\Resources;

use App\Enums\CvStatus;
use App\Filament\Resources\RoleUserResource\Widgets\RoleUserOverview;
use App\Filament\Resources\RoleUserResource\Pages;
use App\Filament\Resources\RoleUserResource\RelationManagers\DetailsRelationManager;
use App\Models\Configuration;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class RoleUserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getSlug(): string
    {
        return Configuration::where('name','RoleUser')->pluck('slug')->first() ?? 'user';
    }

    public static function getLabel(): ?string
    {
        return Configuration::where('name','RoleUser')->pluck('label')->first() ?? 'User';
    }

    public static function getPluralLabel(): ?string
    {
        return Configuration::where('name','RoleUser')->pluck('plural_label')->first() ?? 'Users';
    }

    public static function getNavigationIcon(): string|Htmlable|null
    {
        return Configuration::where('name','RoleUser')->pluck('navigation_icon')->first() != null ? 'heroicon-o-'.Configuration::where('name','RoleUser')->pluck('navigation_icon')->first() : 'heroicon-o-Users';
    }

    public static function getNavigationGroup(): ?string
    {
        return Configuration::with(['configurationCategory'])->where('name','RoleUser')->get()->pluck('configurationCategory.name')->first() ?? 'Authorization System';
    }

    public static function getNavigationSort(): ?int
    {
        return Configuration::where('name','RoleUser')->pluck('navigation_sort')->first() ?? 1;
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return Configuration::where('name','RoleUser')->pluck('navigation_badge_tooltip')->first() ?? 'Number of User';
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()
            ->where('email', '!=', 'admin@admin.com')
            ->where(function($query) {
                $query->whereNull('cv_status')
                    ->orWhere('cv_status', CvStatus::INTERN)
                    ->orWhere('cv_status', CvStatus::HIRED);
            })->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::query()
            ->where('email', '!=', 'admin@admin.com')
            ->where(function($query) {
                $query->whereNull('cv_status')
                    ->orWhere('cv_status', CvStatus::INTERN)
                    ->orWhere('cv_status', CvStatus::HIRED);
            })->count() > 10 ? 'success' : 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Information')
                    ->description('Fill the User Details')
                    ->schema([
                        Forms\Components\Hidden::make('id')
                            ->id('edit_user_id')
                            ->hiddenOn('create'),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Name')
                            ->minLength(3)
                            ->live()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->required()
                            ->password()
                            ->revealable()
                            ->label('Password')
                            ->minLength(5)
                            ->maxLength(40)
                            ->hiddenOn('edit'),
                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->email()
                            ->label('Email')
                            ->minLength(3)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('cnic_number')
                            ->required()
                            ->label('CNIC Number')
                            ->minLength(3)
                            ->live()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('basic_salary')
                            ->required()
                            ->label('Basic Pay')
                            ->minLength(3)
                            ->live()
                            ->maxLength(255),
                        Forms\Components\Select::make('department_id')
                            ->label('Department')
                            ->options(Department::all()->pluck('name', 'id'))
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('designation_id', null);
                            })
                            ->native(false),
                        Forms\Components\Select::make('designation_id')
                            ->label('Designation')
                            ->options(fn (Get $get): Collection => Designation::query()
                                ->where('department_id', $get('department_id'))
                                ->pluck('name', 'id'))
                            ->native(false),
                        Forms\Components\Select::make('status')
                            ->required()
                            ->label('Status')
                            ->options([
                                '0' => 'Inactive',
                                '1' => 'Active',
                            ])
                            ->default(1)
                            ->native(false),
                        Forms\Components\Select::make('roles')
                            ->label('Role')
                            ->multiple()
                            ->searchable()
                            ->native(false)
                            ->preload()
                            ->relationship('roles','name'),
                        Forms\Components\Select::make('permissions')
                            ->label('Permission')
                            ->multiple()
                            ->searchable()
                            ->relationship('permissions','name')
                            ->native(false)
                            ->preload(),
                        Forms\Components\FileUpload::make('profile.path')
                            ->directory(fn(Get $get) => 'users/' . Str::snake(preg_replace('/[^A-Za-z0-9_]/', '',$get('name') ?? 'files' )). '/profile/')
                            ->preserveFilenames()
                            ->label('Upload Profile Pic')
                            ->hint('Upload your latest profile picture')
                            ->reorderable()
                            ->downloadable()
                            ->previewable()
                            ->openable()
                            ->deletable()
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->maxFiles(1)
                            ->moveFiles(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->recordAction(null)
            ->columns([
                Tables\Columns\ImageColumn::make('profile.path')
                    ->label('')
                    ->view('filament.resources.user.table_profile'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable(),
                Tables\Columns\TextColumn::make('designation.name')
                    ->label('Designation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->badge()
                    ->color(fn(int $state): string => match ($state) {
                        0 => 'danger',
                        1 => 'success'
                    })
                    ->formatStateUsing(fn(string $state) => ($state == 1) ? 'Active' : 'Inactive')
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->formatStateUsing(fn(Model|Builder $record): string => $record->created_at->diffForHumans()),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->formatStateUsing(fn(Model|Builder $record): string => $record->updated_at->diffForHumans()),
            ])
            ->filters([
                SelectFilter::make('department_id')
                    ->relationship('department','name')
                    ->native(false)
                    ->label('Filter by Department')
                    ->indicator('Department'),
                SelectFilter::make('designation_id')
                    ->relationship('designation','name')
                    ->native(false)
                    ->label('Filter by Designation')
                    ->indicator('Designation'),
                SelectFilter::make('status')
                    ->options([
                        '0' => 'Inactive',
                        '1' => 'Active',
                    ])
                    ->native(false)
                    ->label('Filter by Status')
                    ->indicator('Status'),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')->columnSpan(1),
                        DatePicker::make('created_until')->columnSpan(1),
                    ])->columns(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): ?array  {
                        $indicator = [];
                        if ($data['created_from']) {
                            $indicator[] = Tables\Filters\Indicator::make('Created From: ' . Carbon::parse($data['created_from'])->toFormattedDateString())
                                ->removeField('created_from');
                        }
                        if ($data['created_until']) {
                            $indicator[] = Tables\Filters\Indicator::make('Created Until: ' . Carbon::parse($data['created_until'])->toFormattedDateString())
                                ->removeField('created_until');
                        }

                        return $indicator;
                    })->columnSpan(2)
            ])
            ->filtersFormColumns(3)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Deleted')
                                ->body('User has been deleted.')
                        )
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoleUsers::route('/'),
            'create' => Pages\CreateRoleUser::route('/create'),
            'view' => Pages\ViewRoleUser::route('/{record}'),
            'edit' => Pages\EditRoleUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('email', '!=', 'admin@admin.com')
            ->where(function($query) {
                $query->whereNull('cv_status')
                    ->orWhere('cv_status', CvStatus::INTERN)
                    ->orWhere('cv_status', CvStatus::HIRED);
            })
            ->latest();
    }

    public static function getWidgets(): array
    {
        return [
            RoleUserOverview::class
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('Auth User View');
    }

    public static function canView(Model $record): bool
    {
        return Auth::user()->can('Auth User View');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('Auth User Create');
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()->can('Auth User Update');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('Auth User Delete');
    }
}
