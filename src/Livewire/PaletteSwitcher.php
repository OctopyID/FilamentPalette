<?php

namespace Octopy\Filament\Palette\Livewire;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Octopy\Filament\Palette\PaletteManager;
use Throwable;

class PaletteSwitcher extends Component
{
    /**
     * @var array
     */
    public array $themes = [];

    /**
     * @var string
     */
    protected string $active = 'teal';

    /**
     * @var PaletteManager
     */
    protected PaletteManager $Palette;

    /**
     * @return void
     * @throws Throwable
     */
    public function mount() : void
    {
        $this->active = $this->manager()->get();
        $this->themes = config('filament-palette.palette', [
            //
        ]);
    }

    /**
     * @return View
     */
    public function render() : View
    {
        return view('octopy.palette::switcher', []);
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return __CLASS__;
    }

    /**
     * @param  string $theme
     * @return void
     * @throws BindingResolutionException
     */
    public function apply(string $theme) : void
    {
        $this->active = $theme;

        $this->manager()->set($theme);

        $this->redirect(url()->previous());
    }

    /**
     * @param  string $theme
     * @return bool
     */
    public function isActive(string $theme) : bool
    {
        return $this->active === $theme;
    }

    /**
     * @return Collection
     */
    public function getThemes() : Collection
    {
        return collect($this->themes)->map(function (array $palette) {
            return [
                'border'     => $this->rgbToHex($palette['primary'][700]),
                'background' => $this->rgbToHex($palette['primary'][400]),
            ];
        });
    }

    /**
     * @param  string $rgb
     * @return string
     */
    private function rgbToHex(string $rgb) : string
    {
        if ($rgb[0] === '#') {
            return $rgb;
        }

        [$r, $g, $b] = array_map('trim', explode(',', $rgb));

        // ensure each component is converted to a 2-digit hex string,
        // padding with a leading zero if the hex value is only one digit.
        $hexR = sprintf('%02x', $r);
        $hexG = sprintf('%02x', $g);
        $hexB = sprintf('%02x', $b);

        return '#' . $hexR . $hexG . $hexB;
    }

    /**
     * @throws BindingResolutionException
     */
    private function manager() : PaletteManager
    {
        return App::make('filament.palette');
    }
}
