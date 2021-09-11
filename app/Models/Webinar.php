<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Webinar extends Model
{
    use HasFactory;
    protected $table = "webinar";
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'tgl_acara',
        'waktu_mulai',
        'waktu_selesai',
        'zoom',
        'poster_img',
        'user_id',
        'pembicara_id'
    ];

    public static function getDetail($id)
    {
       return DB::table('webinar as w')
                ->join('pembicara as p','p.id','=','w.pembicara_id')
                ->join('users as u','u.id','=','w.user_id')
                ->select('w.id','w.judul','w.slug','w.deskripsi','w.tgl_acara','w.waktu_mulai','w.waktu_selesai','w.poster_img','w.zoom',DB::raw('p.nama as pembicara_nama'),DB::raw('p.deskripsi as pembicara_deskripsi'),DB::raw('u.name as admin'))
                ->where('w.id',$id)
                ->first();
    }
}
