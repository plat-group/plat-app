<?php

namespace App\View\Components\Forms;

class Input extends BaseComponent
{

    /**
     * @var string
     */
    public $name;

    /**
     * Input type: text, email, password...
     *
     * @var string
     */
    public $type;

    /**
     * Default value
     *
     * @var string
     */
    public $value;

    /**
     * Need validate
     *
     * @var boolean
     */
    public $required;

    /**
     * @var array[]
     */
    public $options;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name,
        $type = 'text',
        $value = null,
        $options = []
    ) {
        $this->name     = $name;
        $this->type     = $type;
        $this->value    = $value;
        $this->options  = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
