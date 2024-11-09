<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $primaryKey = 'transaksi_id'; 
    protected $fillable = [
        'user_id', 'bin_id', 'category_id', 'items', 'total_amount', 'deposit_date', 'verified'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trashBin()
    {
        return $this->belongsTo(TrashBin::class, 'bin_id', 'bin_id');
    }

    public function wasteCategory()
    {
        return $this->belongsTo(WasteCategory::class, 'category_id', 'category_id');
    }
}
