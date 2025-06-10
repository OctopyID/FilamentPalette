<?php

namespace Octopy\Filament\Palette\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Octopy\Filament\Palette\Livewire\PaletteSwitcher;
use Octopy\Filament\Palette\PaletteManager;

class PaletteServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register() : void
    {
        $this->app->singleton('octopy::palette', function () {
            return new PaletteManager;
        });

        $this->mergeConfigFrom(__DIR__ . '/../../config/filament-palette.php', 'filament-palette');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'octopy.palette');

        Livewire::component('palette-switcher', PaletteSwitcher::class);

        if ($this->app->runningInConsole()) {
            $this
                ->publishes([
                    __DIR__ . '/../../config/filament-palette.php' => config_path('filament-palette.php'),
                ]);
        }
    }
}