<?php

use Filament\Support\Colors\Color;

return [
    'default' => env('FILAMENT_PALETTE_DEFAULT', 'slate'),

    'palette' => [
        'slate'   => [
            'primary' => Color::Slate,
            'warning' => Color::Amber,
            'danger'  => Color::Red,
            'success' => Color::Emerald,
            'info'    => Color::Sky,
        ],
        'stone'   => [
            'primary' => Color::Stone,
            'warning' => Color::Yellow,
            'danger'  => Color::Red,
            'success' => Color::Lime,
            'info'    => Color::Blue,
        ],
        'red'     => [
            'primary' => Color::Red,
            'warning' => Color::Amber,
            'danger'  => Color::Rose,
            'success' => Color::Green,
            'info'    => Color::Cyan,
        ],
        'amber'   => [
            'primary' => Color::Amber,
            'warning' => Color::Yellow,
            'danger'  => Color::Red,
            'success' => Color::Lime,
            'info'    => Color::Blue,
        ],
        'emerald' => [
            'primary' => Color::Emerald,
            'warning' => Color::Yellow,
            'danger'  => Color::Red,
            'success' => Color::Emerald,
            'info'    => Color::Sky,
        ],
        'teal'    => [
            'primary' => Color::Teal,
            'warning' => Color::Amber,
            'danger'  => Color::Red,
            'success' => Color::Emerald,
            'info'    => Color::Blue,
        ],
        'sky'     => [
            'primary' => Color::Sky,
            'warning' => Color::Yellow,
            'danger'  => Color::Red,
            'success' => Color::Green,
            'info'    => Color::Cyan,
        ],
        'violet'  => [
            'primary' => Color::Violet,
            'warning' => Color::Amber,
            'danger'  => Color::Red,
            'success' => Color::Lime,
            'info'    => Color::Sky,
        ],
        'fuchsia' => [
            'primary' => Color::Fuchsia,
            'warning' => Color::Yellow,
            'danger'  => Color::Red,
            'success' => Color::Lime,
            'info'    => Color::Sky,
        ],
    ],
];