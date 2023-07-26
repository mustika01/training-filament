<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function () {
            // Using Vite
            Filament::registerViteTheme('resources/css/filament.css');
         
           
        });

        Filament::registerScripts([
            asset('js/my-script.js'),
        ]);
         
        Filament::registerStyles([
            'https://unpkg.com/tippy.js@6/dist/tippy.css',
            asset('css/my-styles.css'),
        ]);

        Filament::pushMeta([
            new HtmlString('<link rel="manifest" href="/site.webmanifest" />'),
        ]);

        // Filament::registerRenderHook(
        //     'content.start',
        //     fn (): string => Blade::render('hello wrold'),
        // );

//         $recipient = auth()->user();
 
// Notification::make()
//     ->title('Saved successfully')
//     ->sendToDatabase($recipient);
    }
}
