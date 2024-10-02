<?php

namespace App\Filament\App\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class AboutUsPage extends Page
{
    protected static string $view = 'filament.app.pages.about-us-page';

    protected static string $routePath = '/about';

    protected static ?int $navigationSort = 2;

    protected static bool $shouldRegisterNavigation = false;

    public function getTitle(): string | Htmlable
    {
        return '';
    }

    public static function getNavigationLabel(): string
    {
        return __('About Us');
    }

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }

}
