<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';
    protected $primaryKey = 'id_alat';
    public $incrementing = false; // Jika ID bukan auto-increment
    protected $fillable = ['protocol', 'microcontroller', 'mac_address', 'ip_address'];
}
