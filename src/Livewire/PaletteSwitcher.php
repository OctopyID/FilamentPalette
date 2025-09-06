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
                'border'     => $palette['primary'][700],
                'background' => $palette['primary'][400],
            ];
        });
    }

    /**
     * @throws BindingResolutionException
     */
    private function manager() : PaletteManager
    {
        return App::make('filament.palette');
    }
}
