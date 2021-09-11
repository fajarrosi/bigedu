<?php

namespace App\Http\Controllers\Webinar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Webinar;
use Illuminate\Support\Facades\Validator;
use App\Http\Library\ApiHelpers;
use App\Http\Resources\HelperResource;
use DB;

class WebinarController extends Controller
{
    use ApiHelpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         /**
         * jika ada limit maka dilimit 
         * jika ada query search maka webinar difilter berdasarkan keyword
         * jika tidak ada limit maka default nya adalah 10
         */
        try {
            if ($request->limit) {
                $webinar = Webinar::paginate($request->limit);
            }else if($request->search){
                $webinar = Webinar::where('judul', 'like', "%".$request->search."%")->paginate(10);
            }else{
                $webinar = Webinar::paginate(10);
            }
            return HelperResource::collection($webinar);
        } catch (QueryException $e) {
            return $this->onError('Failed ' . $e->ErrorInfo,404);
        }
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
            'judul' => ['required'],
            'slug' => ['required'],
            'deskripsi' =>['required','string'],
            'tgl_acara' => ['required'],
            'waktu_mulai'=> ['required'],
            'waktu_selesai' => ['required'],
            'poster_img' => ['required'],
            'user_id'=> ['required'],
            'pembicara_id' => ['required']
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }

        try {
            $webinar = Webinar::create([
            'judul' => $request->judul,
            'slug' => $request->slug,
            'deskripsi' => $request->deskripsi,
            'tgl_acara' => $request->tgl_acara,
            'waktu_mulai'=> $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'poster_img' => $request->poster_img,
            'user_id' => $request->user_id,
            'pembicara_id' => $request->pembicara_id,
            'zoom' => $request->zoom
            ]);
            return $this->onSuccess($webinar,'Webinar Created Successfully',201);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return $this->onSuccess(Webinar::getDetail($id),'Detail of Webinars');
        } catch (QueryException $e) {
            return $this->onError('Failed ' . $e->ErrorInfo,404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $webinar = Webinar::findOrFail($id);
        $validate = Validator::make($request->all(),[
            'judul' => ['required'],
            'slug' => ['required'],
            'deskripsi' =>['required','string'],
            'tgl_acara' => ['required'],
            'waktu_mulai'=> ['required'],
            'waktu_selesai' => ['required'],
            'poster_img' => ['required'],
            'user_id'=> ['required'],
            'pembicara_id' => ['required']
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }

        try {
            $webinar->update([
                'judul' => $request->judul,
                'slug' => $request->slug,
                'deskripsi' => $request->deskripsi,
                'tgl_acara' => $request->tgl_acara,
                'waktu_mulai'=> $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'poster_img' => $request->poster_img,
                'user_id' => $request->user_id,
                'pembicara_id' => $request->pembicara_id,
                'zoom' => $request->zoom
            ]);
            return $this->onSuccess($webinar,'Webinar Updated Successfully');

        } catch (QueryException $e) {
            return $this->onError('Failed ' . $e->ErrorInfo,404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $webinar = Webinar::findOrFail($id);
        try {
            $webinar->delete();
            return $this->onError('Webinar deleted',200);
        } catch (QueryException $e) {
            return $this->onError('Failed ' . $e->ErrorInfo,404);
        }
    }
}
