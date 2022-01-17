<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TermCreateEdit extends Component
{
    public $taxName;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($taxName)
    {
        //
        $this->taxName = $taxName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.path.component.term-create-edit');
    }
}
