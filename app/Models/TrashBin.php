<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrashBin extends Model
{
    use HasFactory;

    protected $table = 'trash_bins';
    protected $primaryKey = 'bin_id'; 
    public $incrementing = false; // Ini diperlukan jika bin_id bukan auto-increment
    protected $keyType = 'string'; // Pastikan tipe kunci primer sesuai dengan jenis data yang digunakan

    protected $fillable = [
        'location', 'qr_code', 'name', 'status', 'bin_id', // Pastikan 'bin_id' disertakan di sini
        'qr_code_path' // Jika Anda juga menyimpan path QR code
    ];
}
