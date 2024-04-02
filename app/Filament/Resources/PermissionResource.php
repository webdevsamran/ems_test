<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionResource\Pages;
use App\Filament\Resources\PermissionResource\RelationManagers;
use App\Filament\Resources\PermissionResource\Widgets\PermissionOverview;
use App\Models\Configuration;
use App\Models\Permission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
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

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    public static function getSlug(): string
    {
        return Configuration::where('name','Permission')->pluck('slug')->first() ?? 'permission';
    }

    public static function getLabel(): ?string
    {
        return Configuration::where('name','Permission')->pluck('label')->first() ?? 'Permission';
    }

    public static function getPluralLabel(): ?string
    {
        return Configuration::where('name','Permission')->pluck('plural_label')->first() ?? 'Permissions';
    }

    public static function getNavigationIcon(): string|Htmlable|null
    {
        return Configuration::where('name','Permission')->pluck('navigation_icon')->first() != null ? 'heroicon-o-'.Configuration::where('name','Permission')->pluck('navigation_icon')->first() : 'heroicon-o-key';
    }

    public static function getNavigationGroup(): ?string
    {
        return Configuration::with(['configurationCategory'])->where('name','Permission')->get()->pluck('configurationCategory.name')->first() ?? 'Authorization System';
    }

    public static function getNavigationSort(): ?int
    {
        return Configuration::where('name','Permission')->pluck('navigation_sort')->first() ?? 3;
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return Configuration::where('name','Permission')->pluck('navigation_badge_tooltip')->first() ?? 'Number of Permissions';
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
                Forms\Components\Section::make('Permission')
                    ->description('Type the Permission you want to create')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Permission')
                            ->minLength(2),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->columnSpanFull()
                            ->maxLength(255),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->recordAction(null)
            ->defaultPaginationPageOption(50)
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Permission')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
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
                                ->body('The Permission has been deleted.')
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
                Grid::make(2)
                    ->schema([
                        Section::make([
                            TextEntry::make('name'),
                        ])->columnSpan(1),
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
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
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
            PermissionOverview::class
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('Auth Permission View');
    }

    public static function canView(Model $record): bool
    {
        return Auth::user()->can('Auth Permission View');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('Auth Permission Create');
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()->can('Auth Permission Update');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('Auth Permission Delete');
    }
}
