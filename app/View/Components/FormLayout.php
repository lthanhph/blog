<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormLayout extends Component
{
    public $route;
    public $method;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $method)
    {
        //
        $this->route = $route;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.layout.form');
    }
}
