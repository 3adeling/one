<?php

namespace App\Filament\Resources\RegionResource\RelationManagers;

use App\Filament\Resources\CityResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'cities';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Cities');
    }

    public function form(Form $form): Form
    {
        return CityResource::form($form);
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return $ownerRecord->is_active;
    }

    public function table(Table $table): Table
    {
        return CityResource::table($table)
                ->actions([
                    Tables\Actions\ViewAction::make()
                        ->url(fn ($record): string => CityResource::getUrl('view', ['record' => $record->id]))
                ]);
    }
}
