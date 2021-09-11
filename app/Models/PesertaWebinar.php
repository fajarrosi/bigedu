<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaWebinar extends Model
{
    use HasFactory;
    protected $table = "peserta_webinar";
    protected $fillable = [
        'webinar_id',
        'peserta_id'
    ];
}
