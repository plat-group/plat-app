<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

abstract class BaseComponent extends Component
{

    /**
     * Need validate is required
     *
     * @return string
     */
    public function required()
    {
        return property_exists($this, 'required') && $this->required ? 'required' : '';
    }
}
