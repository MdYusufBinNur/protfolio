<?php

namespace MyProfile\Http\Controllers\Api;

use MyProfile\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use MyProfile\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return User::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        //return $request->photo;
        $this->validate($request,[
           'name' => "required|string|max:191",
           'email' => "required|string|email|max:191|unique:users",
           'type' => "required|string|max:191",
           'password' => "required|string|min:6",
            'photo' => "required"

        ]);
        $directory = "";
        if ($request->photo){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            $directory = "img/profile/".$name;
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
        }
        return User::create(
            [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'type' => $request['type'],
                'bio' => $request['bio'],
                'photo' =>  $directory
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $this->validate($request,[
            'name' => "required|string|max:191",
            'email' => "required|string|email|max:191|unique:users,email,".$user->id,
            'type' => "required|string|max:191",
            'password' => "sometimes|min:6",

        ]);
        $user->update($request->all());
        return response()->json(['message'=>"Data Updated"]);
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
        if ($user){
            File::delete($user->photo);
            $user->delete();
            return response()->json('user deleted');
        }
       else{
           return response()->json('Failed to  delete');
       }

    }
}
