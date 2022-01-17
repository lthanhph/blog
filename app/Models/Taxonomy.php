<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    use HasFactory;
    protected $table = 'taxonomy';
    protected $fillable = ['name'];

    public function term () {
        return $this->hasMany(Term::class);
    }

    public static function taxExists($tax_name) 
    {
        $tax = self::where('name', $tax_name)->first();
        if (!empty($tax)) {
            return true;
        }
        return false;
    }

    public static function getTaxByName($tax_name)
    {
        $tax = self::where('name', $tax_name)->first();
        if (!empty($tax)) {
            return $tax;
        }
        return false;
    }
}
