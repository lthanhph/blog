<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    protected $table = 'menu_item';
    protected $fillable = [
        'title',
        'url',
        'depth',
        'menu_id',
    ];

    public function menu () {
        return $this->belongsTo(Menu::class);
    }
}
