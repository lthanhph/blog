<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CommentForm extends Component
{
    public $postId;
    public $replyTo;
    public $parent;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($postId, $replyTo, $parent)
    {
        //
        $this->postId = $postId;
        $this->replyTo = $replyTo;
        $this->parent = $parent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('public.component.comment-form');
    }
}
