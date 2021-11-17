<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Message extends Component
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('components.forms.message');
    }
}
