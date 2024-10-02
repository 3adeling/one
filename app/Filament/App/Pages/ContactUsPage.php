<?php

namespace App\Filament\App\Pages;

use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class ContactUsPage extends Page implements HasForms
{
    protected static string $view = 'filament.app.pages.contact-us-page';

    protected static string $routePath = '/contact';

    protected static ?int $navigationSort = 3;

    protected static bool $shouldRegisterNavigation = false;
    
    public function getTitle(): string | Htmlable
    {
        return '';
    }

    public static function getNavigationLabel(): string
    {
        return __('Contact Us');
    }

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }

}
