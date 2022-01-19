<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Term;
use App\Models\Menu;
use App\Models\MenuItem;

class MenuController extends Controller
{
    //
    public function showConfig()
    {
        $menu = Menu::where('position', 'navigation')->first();
        $items = $menu->menuItem()->get();
        return view('admin.path.menu-config', [
            'post' => Post::all(),
            'category' => Term::whereRelation('taxonomy', 'name', 'category')->get(),
            'tag' => Term::whereRelation('taxonomy', 'name', 'tag')->get(),
            'menu' => $menu,
            'items' => $items,
        ]);
    }

    public function updateItem(Request $request, $id)
    {
        $validated = $request->validate([
            'item_title' => 'nullable|array',
            'item_url' => 'nullable|array',
        ]);

        // delete all old item
        $this->destroyItem($id);

        // add new item
        foreach ($validated['item_title'] as $index => $title) {
            MenuItem::create([
                'title' => $title,
                'url' => $validated['item_url'][$index],
                'depth' => 0,
                'menu_id' => $id,
            ]);
        }

        return redirect()->route('menu.show-config');
    }

    public function destroyItem($id)
    {
        $items = Menu::find($id)->menuItem()->get();
        if ($items->isNotEmpty()) {
            foreach ($items as $item) {
                MenuItem::destroy($item->id);
            }
        }
    }
}
