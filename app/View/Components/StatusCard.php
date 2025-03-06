<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatusCard extends Component
{
    public string $title;
    public string $count;
    public string $color;
    public string $icon;

    public function __construct(string $title, string $count, string $color, string $icon)
    {
        $this->title = $title;
        $this->count = $count;
        $this->color = $color;
        $this->icon = $icon;
    }

    public function render()
    {
        return view('components.status-card');
    }
}
