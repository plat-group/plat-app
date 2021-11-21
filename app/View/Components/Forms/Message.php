<?php

namespace App\View\Components\Forms;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\View\Component;

class Message extends Component
{

    /**
     * List messages
     *
     * @var array
     */
    public $messages = [];

    /**
     * Type of message
     *
     * @var string
     */
    public $type = 'danger';

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $messages = Session::get('errors', new MessageBag());
        if ($messages->has('message') || $messages->count() > 0) {
            $allBag = $messages->all();
            $this->messages = count($allBag) > 1 ? $allBag : $allBag[0];
        }

        // Get from session
        if (Session::has('success') || Session::has('message')) {
            $this->type = 'success';
            $this->messages = Session::get('success', Session::get('message'));
        }

        return view('components.forms.message');
    }
}
