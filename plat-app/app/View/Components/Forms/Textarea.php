<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Textarea extends Component
{

    /**
     * @var mixed|null
     */
    public $label;

    /**
     * @var mixed|null
     */
    public $value;

    /**
     * @param null $label
     * @param null $value
     */
    public function __construct($label = null, $value = null)
    {
        $this->label = $label;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('components.forms.textarea');
    }
}
