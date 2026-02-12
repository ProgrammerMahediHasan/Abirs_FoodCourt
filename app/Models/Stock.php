<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['menu_id', 'current_quantity', 'unit'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}