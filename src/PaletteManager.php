<?php

namespace Octopy\Filament\Palette;

use Closure;
use Filament\Support\Concerns\EvaluatesClosures;
use Throwable;

class PaletteManager
{
    use EvaluatesClosures;

    /**
     * @var string
     */
    private const CACHE_KEY_PREFIX = 'octopy.filament.palette';

    /**
     * @var Closure|bool
     */
    protected Closure|bool $hidden = false;

    /**
     * @var Closure|bool
     */
    protected Closure|bool $globally = false;

    /**
     * @param  string $theme
     * @return string
     */
    public function set(string $theme) : string
    {
        $cacheKey = $this->getCacheKey();

        cache()->forget($cacheKey);

        return cache()->rememberForever($cacheKey, fn() => $theme);
    }

    /**
     * @throws Throwable
     */
    public function get() : string|null
    {
        $cacheKey = $this->getCacheKey();

        return
            cache()->has($cacheKey)
                ? cache()->get($cacheKey)
                : config('filament-palette.default');
    }

    /**
     * @throws Throwable
     */
    public function getColors() : array
    {
        return
            config('filament-palette.palette.' . $this->get(), [
                //
            ]);
    }

    /**
     * @param  Closure|bool $hidden
     * @return $this
     */
    public function hidden(Closure|bool $hidden = true) : PaletteManager
    {
        $this->hidden = $hidden;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHidden() : bool
    {
        return $this->evaluate($this->hidden);
    }

    /**
     * @param  Closure|bool $globally
     * @return $this
     */
    public function applyThemeGlobally(Closure|bool $globally) : PaletteManager
    {
        $this->globally = $globally;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasThemeGlobally() : bool
    {
        return $this->evaluate($this->globally);
    }

    /**
     * @return string
     */
    private function getCacheKey() : string
    {
        return
            $this->hasThemeGlobally()
                ? self::CACHE_KEY_PREFIX
                : self::CACHE_KEY_PREFIX . ':' . md5(auth()->id());
    }
}