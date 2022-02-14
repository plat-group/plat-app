<?php

namespace App\View\Components\Forms;

class Select extends BaseComponent
{

    /**
     * @var string
     */
    public $name;

    /**
     * List select
     *
     * @var string['value' => 'label']
     */
    public $list;

    /**
     * Default option selected
     *
     * @var mixed
     */
    public $selected;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $list = [], $selected = null)
    {
        $this->name     = $name;
        $this->list     = $list;
        $this->selected = $selected;
    }

    /**
     * Get the view / view contents that represent the component.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('components.forms.select');
    }
}
