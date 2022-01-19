<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Taxonomy;

class PostCreateEdit extends Component
{
    public $post;
    public $route;
    public $method;
    public $categories;
    public $tags;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post, $route, $method)
    {
        //
        $this->post = $post;
        $this->route = $route; 
        $this->method = $method;

        $this->categories = Taxonomy::firstWhere('name', 'category')->term;
        $this->tags = Taxonomy::firstWhere('name', 'tag')->term;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.path.component.post-create-edit');
    }
}
