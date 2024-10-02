<?php

namespace App\Filament\App\Widgets;

use App\Models\ContactUsRequest;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;

class ContactUsRequestWidget extends Widget implements HasForms, HasActions
{
    use InteractsWithActions, InteractsWithForms;

    protected static string $view = 'filament.app.widgets.contact-us-request-widget';

    public function contactUsAction(): Action
    {
        return Action::make('contactUs')
                ->label(__('Contact Us'))
                ->translateLabel()
                ->slideOver()
                ->modalWidth('md')
                ->form([
                    TextInput::make('name')->label('Name')->translateLabel()->required(),
                    TextInput::make('contact_number')->label('Contact Number')->translateLabel()->requiredWithout('email'),
                    TextInput::make('email')->label('Email')->translateLabel()->requiredWithout('contact_number'),
                    MarkdownEditor::make('notes')->required(),
                ])->action(function (array $data) {
                    ContactUsRequest::create($data);

                    Notification::make()
                        ->title(__('Interest created! We will get back to you soon.'))
                        ->success()
                        ->send();
                });
    }
}
