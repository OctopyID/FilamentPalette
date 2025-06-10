<div class="fi-theme-switcher grid grid-cols-10 px-3 py-2 items-center">
    @foreach($this->getThemes() as $name => $theme)
        <div
            title="{{ str($name)->upper() }}"
            wire:click="apply('{{ $name }}')"
            @class([
                'w-4 h-4 rounded-full cursor-pointer',
                'border-2' => $this->isActive($name),
            ])
            style="background-color: {{ $theme['background'] }};{{ $this->isActive($name) ? 'border-color: ' . $theme['border'] : ''  }}"
        ></div>
    @endforeach
</div>