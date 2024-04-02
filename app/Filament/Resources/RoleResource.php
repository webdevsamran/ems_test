<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Filament\Resources\RoleResource\Widgets\RoleOverview;
use App\Models\Configuration;
use App\Models\Permission;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    public static function getSlug(): string
    {
        return Configuration::where('name','Role')->pluck('slug')->first() ?? 'role';
    }

    public static function getLabel(): ?string
    {
        return Configuration::where('name','Role')->pluck('label')->first() ?? 'Role';
    }

    public static function getPluralLabel(): ?string
    {
        return Configuration::where('name','Role')->pluck('plural_label')->first() ?? 'Roles';
    }

    public static function getNavigationIcon(): string|Htmlable|null
    {
        return Configuration::where('name','Role')->pluck('navigation_icon')->first() != null ? 'heroicon-o-'.Configuration::where('name','Role')->pluck('navigation_icon')->first() : 'heroicon-o-finger-print';
    }

    public static function getNavigationGroup(): ?string
    {
        return Configuration::with(['configurationCategory'])->where('name','Role')->get()->pluck('configurationCategory.name')->first() ?? 'Authorization System';
    }

    public static function getNavigationSort(): ?int
    {
        return Configuration::where('name','Role')->pluck('navigation_sort')->first() ?? 2;
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return Configuration::where('name','Role')->pluck('navigation_badge_tooltip')->first() ?? 'Number of Roles';
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'success' : 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Role')
                    ->description('Type the Role you want to create')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Role')
                            ->minLength(2),
                        Forms\Components\CheckboxList::make('permissions')
                            ->relationship('permissions','name')
                            ->descriptions(Permission::all()->pluck('description','id'))
                            ->searchable()
                            ->columns(4)
                            ->gridDirection('row')
                            ->bulkToggleable()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->recordAction(null)
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Role')
                    ->searchable(),
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
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Deleted')
                                ->body('The Role has been deleted.')
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
            //
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Grid::make(3)
                    ->schema([
                        Section::make([
                            TextEntry::make('name')
                                ->label('Role Name')
                                ->columnSpanFull(),
                            RepeatableEntry::make('permissions')
                                ->view('filament.resources.role.permissions'),
                        ])->columnSpan(2),
                        Section::make([
                            TextEntry::make('created_at')
                                ->dateTime('l, F j, Y \a\t g:i A'),
                            TextEntry::make('updated_at')
                                ->dateTime('l, F j, Y \a\t g:i A'),
                        ])->columnSpan(1)
                    ])
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->latest();
    }

    public static function getWidgets(): array
    {
        return [
            RoleOverview::class
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('Auth Role View');
    }

    public static function canView(Model $record): bool
    {
        return Auth::user()->can('Auth Role View');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('Auth Role Create');
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()->can('Auth Role Update');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('Auth Role Delete');
    }
}
