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
     * @param  PaletteManager $Palette
     */
    public function __construct(protected PaletteManager $Palette)
    {
        //
    }

    /**
     * @throws Throwable
     */
    public function handle(Request $request, Closure $next)
    {
        $colors = $this->Palette->getColors();

        if (filled($colors)) {
            FilamentColor::register($colors);
        }

        return $next($request);
    }
}
