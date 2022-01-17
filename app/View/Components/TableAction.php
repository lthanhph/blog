<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableAction extends Component
{
    public $index;
    public $routeShow;
    public $routeEdit;
    public $routeDestroy;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($index, $routeShow = false, $routeEdit, $routeDestroy)
    {
        //
        $this->index = $index;
        $this->routeShow = $routeShow;
        $this->routeEdit = $routeEdit;
        $this->routeDestroy = $routeDestroy;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.path.component.table-action');
    }
}
