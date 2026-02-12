<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Table name (optional, Laravel will assume 'customers' by default)
    protected $table = 'customers';

    // Mass assignable fields
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status',
    ];

    // Timestamps enabled (default true)
    public $timestamps = true;
}
