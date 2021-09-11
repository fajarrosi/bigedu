<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Http\Library\ApiHelpers;

class PesertaController extends Controller
{
    use ApiHelpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email' => ['required','email'],
            'name' => ['required'],
            'nomor_wa' =>['required'],
            'pekerjaan'=>['required'],
            'instansi'=>['required'],
            'domisili'=>['required']
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }

        try {
            $peserta = Peserta::updateOrCreate([
                'email' => $request->email,
            ],[
                'name' => $request->name,
                'nomor_wa' => $request->nomor_wa,
                'pekerjaan'=>$request->pekerjaan,
                'instansi'=>$request->instansi,
                'domisili'=>$request->domisili
            ]);
            $condition =  DB::table('peserta_webinar')
                        ->where('webinar_id',$request->webinar_id)
                        ->where('peserta_id',$peserta->id)
                        ->get();
            
            if ($condition->isEmpty()) {
                $peserta_webinar = DB::table('peserta_webinar')
                             ->insert([
                                 'webinar_id' => $request->webinar_id,
                                 'peserta_id' => $peserta->id,
                                 'created_at' => now(),
                                 'updated_at' => now()
                             ]);
                return $this->onSuccess($peserta,'Peserta berhasil mendaftar',201);
            }else{
                return $this->onError('Peserta sudah terdaftar',200);
            }
        } catch (QueryException $e) {
            return $this->onError('Failed ' . $e->ErrorInfo,404);
            // return response()->json([
            //     'message' => 'Failed ' . $e->ErrorInfo
            // ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function show(Peserta $peserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peserta $peserta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peserta $peserta)
    {
        //
    }
}
