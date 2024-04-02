<?php

namespace App\Filament\Resources\RoleUserResource\Pages;

use App\Filament\Resources\RoleUserResource;
use Filament\Actions\Action;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewRoleUser extends ViewRecord
{
    protected static string $resource = RoleUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Go Back')
                ->icon('heroicon-o-arrow-left')
                ->url(fn () => $this->previousUrl ?? static::getResource()::getUrl('index')),
        ];}

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Grid::make(4)
                    ->schema([
                        Section::make([
                            ImageEntry::make('profile.path')
                                ->view('filament.resources.user.profile')
                                ->alignCenter()
                                ->columnSpan(1),
                        ])
                            ->columnSpan(1),
                        Section::make([
                            TextEntry::make('name')
                                ->label('Name')
                                ->columnSpan(1),
                            TextEntry::make('email')
                                ->label('Email')
                                ->copyable()
                                ->color('primary')
                                ->columnSpan(1),
                            TextEntry::make('status')
                                ->label('Status')
                                ->color(fn(int $state): string => match ($state) {
                                    0 => 'danger',
                                    1 => 'success'
                                })
                                ->formatStateUsing(fn(string $state) => ($state == 1) ? 'Active' : 'Inactive')
                                ->columnSpan(1),
                            TextEntry::make('department.name')
                                ->label('Department'),
                            TextEntry::make('designation.name')
                                ->label('Designation'),
                            RepeatableEntry::make('roles')
                                ->view('filament.resources.user.roles')
                                ->columnSpanFull(),
                            RepeatableEntry::make('id')
                                ->view('filament.resources.user.permissions')
                                ->columnSpanFull(),
                        ])
                            ->columns(3)
                            ->columnSpan(3),
                        Section::make([
                            TextEntry::make('created_at')
                                ->dateTime('l, F j, Y \a\t g:i A')
                                ->columnSpan(1),
                            TextEntry::make('updated_at')
                                ->dateTime('l, F j, Y \a\t g:i A')
                                ->columnSpan(1)
                        ])
                            ->columns(2)
                            ->columnSpanFull()
                    ])
            ]);
    }
}
