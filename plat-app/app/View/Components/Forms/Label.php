<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Label extends Component
{

    /**
     * @var mixed|string
     */
    public $label;

    /**
     * @param string $label
     */
    public function __construct(string $label = '')
    {
        $this->label = $label;
    }

    /**
     * Get the view / view contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\Support\Htmlable|\Closure|string
     */
    public function render()
    {
        return view('components.forms.label');
    }
}
