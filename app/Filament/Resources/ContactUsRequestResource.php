<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactUsRequestResource\Pages;
use App\Models\ContactUsRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactUsRequestResource extends Resource
{
    protected static ?string $model = ContactUsRequest::class;
    protected static ?string $slug = 'contact-us-requests';

    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-rays';

    public static function getModelLabel(): string
    {
        return __('Contact Us Request');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Contact Us Requests');
    }



    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->translateLabel()
                    ->required(),
                Forms\Components\TextInput::make('contact_number')
                    ->label('Contact Number')
                    ->translateLabel()
                    ->requiredWithout('email'),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->translateLabel()
                    ->requiredWithout('contact_number'),
                Forms\Components\MarkdownEditor::make('notes')
                    ->label('Notes')
                    ->translateLabel()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_number')
                    ->label('Contact Number')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->slideOver()->modalWidth('md'),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactUsRequests::route('/'),
        ];
    }
}
