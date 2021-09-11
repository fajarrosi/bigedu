<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $table = "peserta";
    protected $fillable = [
        'name',
        'email',
        'nomor_wa',
        'pekerjaan',
        'instansi',
        'domisili'
    ];
}
