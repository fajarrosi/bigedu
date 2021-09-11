<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Library\ApiHelpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\HelperResource;

class UserController extends Controller
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
         * jika ada query search maka User difilter berdasarkan keyword
         * jika tidak ada limit maka default nya adalah 10
         */
        try {
            if ($request->limit) {
                $user = User::paginate($request->limit);
            }else if($request->search){
                $user = User::where('name', 'like', "%".$request->search."%")->paginate(10);
            }else{
                $user = User::paginate(10);
            }
            return HelperResource::collection($user);
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
            'email' => ['required','email'],
            'name' => ['required'],
            'password' =>['required','string'],
            'role' => ['required','in:admin,mentor,mentee']
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }

        try {
            $user = User::create([
                'name' =>$request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
            return $this->onSuccess($user,'User Created Successfully',201);

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
        $user = User::findOrFail($id);
        try {
            return $this->onSuccess($user,'Detail of User');
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
        $user = User::findOrFail($id);
        $validate = Validator::make($request->all(),[
            'email' => ['required','email'],
            'name' => ['required'],
            'password' =>['required','string'],
            'role' => ['required','in:admin,mentor,mentee']
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }

        try {
            $user->update([
                'name' =>$request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
            return $this->onSuccess($user,'User Updated Successfully');

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
        $user = User::findOrFail($id);
        try {
            $user->delete();
            return $this->onError('User deleted',200);
        } catch (QueryException $e) {
            return $this->onError('Failed ' . $e->ErrorInfo,404);
        }
        
    }
}
