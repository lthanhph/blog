<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Comment extends Component
{
    // comment model
    public $comment;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        //
        $this->comment = $comment;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('public.component.comment');
    }
}
