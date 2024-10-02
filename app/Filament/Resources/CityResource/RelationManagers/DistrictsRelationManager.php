<?php

namespace App\Filament\Resources\CityResource\RelationManagers;

use App\Filament\Resources\DistrictResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DistrictsRelationManager extends RelationManager
{
    protected static string $relationship = 'districts';

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return $ownerRecord->is_active;
    }

    public function form(Form $form): Form
    {
        return DistrictResource::form($form);
    }

    public function table(Table $table): Table
    {
        return DistrictResource::table($table)
                ->actions([
                    Tables\Actions\ViewAction::make()
                        ->url(fn ($record): string => DistrictResource::getUrl('view', ['record' => $record->id])),
                ]);
    }
}
