<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthLayout extends Component
{
    public $siteTitle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($siteTitle)
    {
        //
        $this->siteTitle = $siteTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('auth.layout.main');
    }
}
