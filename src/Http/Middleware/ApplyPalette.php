<?php

namespace Octopy\Filament\Palette\Http\Middleware;

use Closure;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Http\Request;
use Octopy\Filament\Palette\PaletteManager;
use Throwable;

class ApplyPalette
{
    /**
     * @param  PaletteManager $manager
     */
    public function __construct(protected PaletteManager $manager)
    {
        //
    }

    /**
     * @throws Throwable
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $this->manager->isHidden()) {
            $colors = $this->manager->getColors();

            if (filled($colors)) {
                FilamentColor::register($colors);
            }
        }

        return $next($request);
    }
}
