<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Loadmore extends Component
{
    public $route;
    public $element; // html element used to put the loop inside it.
    public $offset;
    public $limit;
    public $total;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $element, $offset, $limit, $total)
    {
        //
        $this->route = $route;
        $this->element = $element;
        $this->offset = $offset;
        $this->limit = $limit;
        $this->total = $total;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('public.component.loadmore');
    }
}
