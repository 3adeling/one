<?php

namespace App\Filament\Resources\CityResource\Pages;

use App\Filament\Resources\CityResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
use Filament\Resources\Pages\ViewRecord;

class ViewCity extends ViewRecord
{
    use Translatable;

    protected static string $resource = CityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
            Actions\Action::make('activate')
                ->label('Activate')
                ->translateLabel()
                ->color('success')
                ->action(function() {
                     $this->record->update(['is_active' => true]);
                })
                ->after(function() {
                    redirect()->to(route('filament.admin.resources.cities.view', $this->record));
                })
                ->hidden($this->record->is_active),
            Actions\Action::make('deactivate')
                ->label('Deactivate')
                ->translateLabel()
                ->color('danger')
                ->action(function() {
                    $this->record->update(['is_active' => false]);
                })
                ->after(function() {
                    redirect()->to(route('filament.admin.resources.cities.view', $this->record));
                })
                ->hidden(! $this->record->is_active),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make(__('Region Information'))
                    ->columns(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('name')->translateLabel(),
                    ]),

            ]);
    }
}
