<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $displayedName,
        public string $type = 'text',
        public string $value = '',
        public bool $readonly = false,
        public string $faIcon = '',
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
