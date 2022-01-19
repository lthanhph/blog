<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Menu;

class NavMenu extends Component
{
    public $menu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->menu = Menu::firstWhere('position', 'navigation');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('public.component.nav-menu');
    }
}
