<?php

namespace App\Http\Controllers\webinar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembicara;
use Illuminate\Support\Facades\Validator;
use App\Http\Library\ApiHelpers;
use App\Http\Resources\HelperResource;

class PembicaraController extends Controller
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
         * jika ada query search maka pembicara difilter berdasarkan keyword
         * jika tidak ada limit maka default nya adalah 10
         */
        try {
            if ($request->limit) {
                $pembicara = Pembicara::paginate($request->limit);
            }else if($request->search){
                $pembicara = Pembicara::where('nama', 'like', "%".$request->search."%")->paginate(10);
            }else{
                $pembicara = Pembicara::paginate(10);
            }
            return HelperResource::collection($pembicara);
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
            'nama' => ['required'],
            'deskripsi' =>['required','string'],
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }

        try {
            $pembicara = Pembicara::create([
                'nama' =>$request->nama,
                'deskripsi' =>$request->deskripsi
            ]);
            return $this->onSuccess($pembicara,'Pembicara Created Successfully',201);

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
        $pembicara = Pembicara::findOrFail($id);
        try {
            return $this->onSuccess($pembicara,'Detail of Pembicara');
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
        $pembicara = Pembicara::findOrFail($id);
        $validate = Validator::make($request->all(),[
            'deskripsi' => ['required'],
            'nama' => ['required'],
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }

        try {
            $pembicara->update([
                'nama' =>$request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
            return $this->onSuccess($pembicara,'Pembicara Updated Successfully');

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
        $pembicara = Pembicara::findOrFail($id);
        try {
            $pembicara->delete();
            return $this->onError('Pembicara deleted',200);
        } catch (QueryException $e) {
            return $this->onError('Failed ' . $e->ErrorInfo,404);
        }
    }
}
