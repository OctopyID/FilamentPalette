<?php

namespace Octopy\Filament\Palette;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\View\PanelsRenderHook as Hook;
use Illuminate\Support\Facades\Blade;
use Octopy\Filament\Palette\Http\Middleware\ApplyPalette;

class PaletteSwitcherPlugin implements Plugin
{
    /**
     * @return string
     */
    public function getId() : string
    {
        return 'filament-palette';
    }

    /**
     * @return static
     */
    public static function make() : static
    {
        return new static;
    }

    /**
     * @param  Panel $panel
     * @return void
     */
    public function boot(Panel $panel) : void
    {
        //
    }

    /**
     * @param  Panel $panel
     * @return void
     */
    public function register(Panel $panel) : void
    {
        $panel
            ->renderHook(Hook::USER_MENU_PROFILE_AFTER, function () {
                if (! app('octopy::palette')->isHidden()) {
                    return Blade::render('<livewire:palette-switcher />');
                }

                return null;
            })
            ->authMiddleware([
                ApplyPalette::class,
            ]);
    }

    /**
     * @param  Closure|bool $hidden
     * @return PaletteSwitcherPlugin
     */
    public function hidden(Closure|bool $hidden = true) : PaletteSwitcherPlugin
    {
        return tap($this, fn() => app('octopy::palette')->hidden($hidden));
    }

    /**
     * @param  Closure|bool $globally
     * @return PaletteSwitcherPlugin
     */
    public function applyThemeGlobally(Closure|bool $globally = true) : PaletteSwitcherPlugin
    {
        return tap($this, fn() => app('octopy::palette')->applyThemeGlobally($globally));
    }
}