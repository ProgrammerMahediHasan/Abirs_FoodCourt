<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

protected $table="menus";

    // Mass assignable fields
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'status',
    ];

    /**
     * Relationship: Menu belongs to a Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

   public function stock()
{
    return $this->hasOne(Stock::class);
}

}