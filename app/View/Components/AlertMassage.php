<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertMassage extends Component
{
    Public $massage;
    /**
     * Create a new component instance.
     */
    public function __construct($massage)

    {
        $this->massage=$massage;
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert-massage');
    }
}
