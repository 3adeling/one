<?php

namespace App\Filament\App\Pages;

use App\Models\City;
use App\Models\District;
use App\Models\Post;
use App\Models\Region;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class HomePage extends Page implements HasForms, HasActions
{
    use InteractsWithForms, InteractsWithActions;

    protected static string $view = 'filament.app.pages.home-page';

    protected static string $routePath = '/';

    protected static ?int $navigationSort = 1;

    protected static bool $shouldRegisterNavigation = false;

    public Collection $posts;

    public function addPostAction(): Action
    {
        // if not authenticated, redirect to login page
        if (!Auth::check()) {
            return Action::make('login')
                ->label('Login')
                ->translateLabel()
                ->url(route('filament.app.auth.login'));
        }

        return Action::make('addPost')
                ->label('Add Post')
                ->translateLabel()
                ->slideOver()
                ->form([
                    TextInput::make('title')
                        ->label('Title')
                        ->translateLabel()
                        ->placeholder('Enter title')
                        ->required(),
                    Select::make('region')
                        ->label('Region')
                        ->translateLabel()
                        ->placeholder('Select Region')
                        ->required()
                        ->searchable()
                        ->live()
                        ->options(fn () => Region::isActive()->pluck('name', 'id')),
                    Select::make('city')
                        ->label('City')
                        ->translateLabel()
                        ->placeholder('Select City')
                        ->required()
                        ->searchable()
                        ->live()
                        ->hidden(fn (Get $get) => !$get('region'))
                        ->options(fn (Get $get) => City::isActive()->where('region_id', $get('region'))->get()->pluck('name', 'id')),
                    Select::make('district')
                        ->label('District')
                        ->translateLabel()
                        ->placeholder('Select District')
                        ->required()
                        ->searchable()
                        ->live()
                        ->hidden(fn (Get $get) => !$get('city'))
                        ->options(fn (Get $get) => District::isActive()->where('city_id', $get('city'))->get()->pluck('name', 'id')),
                    RichEditor::make('content')
                        ->label('Content')
                        ->translateLabel()
                        ->placeholder('Enter content')
                        ->required(),
                    FileUpload::make('attachments')
                        ->label('Attachments')
                        ->translateLabel()
                        ->placeholder('Upload attachments')
                        ->multiple()
                        ->image(),
                ])
                ->action(function (array $data) {
                    Post::create([
                        'title' => $data['title'],
                        'content' => $data['content'],
                        'user_id' => Auth::id(),
                        'attachments' => $data['attachments'],
                    ]);
                });
            }

    public function getTitle(): string | Htmlable
    {
        return '';
    }

    public static function getNavigationLabel(): string
    {
        return __('Home');
    }

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }

    public function mount(): void
    {
        $this->posts = Post::all();
    }

}
