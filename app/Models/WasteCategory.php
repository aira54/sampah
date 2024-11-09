<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteCategory extends Model
{
    use HasFactory;

    protected $table = 'waste_categories';
    protected $primaryKey = 'category_id'; 
    protected $fillable = [
        'name', 'description', 'price_per_kg','status'
    ];
}
