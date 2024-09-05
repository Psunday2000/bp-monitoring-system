<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public string $layout;

    /**
     * Create a new component instance.
     *
     * @param string $layout
     * @return void
     */
    public function __construct(string $layout = 'default')
    {
        $this->layout = $layout;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        $layoutView = match ($this->layout) {
            'caregiver' => 'caregiver.layouts.app',
            'patient' => 'patient.layouts.app',
            default => 'layouts.app',
        };

        return view($layoutView);
    }
}
