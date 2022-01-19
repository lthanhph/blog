<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $fillable = [
        'name',
        'position'
    ];

    public function menuItem()
    {
        return $this->hasMany(MenuItem::class);
    }

    // public function getItems()
    // {
    //     $items = $this->menuItem()->where('menu_id', $this->id)->get();
    //     return $items;
    // }
}
