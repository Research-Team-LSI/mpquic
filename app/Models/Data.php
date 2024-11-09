<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alat;

class Data extends Model
{
    use HasFactory;

    protected $table = 'data';

    protected $fillable = [
        'id_alat',
        'throughput',
        'latency'
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat');
    }
}
