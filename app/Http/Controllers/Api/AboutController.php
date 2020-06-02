<?php

namespace MyProfile\Http\Controllers\Api;

use Illuminate\Support\Facades\File;
use MyProfile\Http\Controllers\Controller;
use MyProfile\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function index()
    {
        return About::latest()->paginate(10);
    }

    public function store(Request $request)
    {
        //return $request->photo;
        $this->validate($request,[
            'title' => "required|string",
            'description' => "required",
            'image' => "required"

        ]);
        $directory = "";
        if ($request->image){
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            $directory = "img/About/".$name;
            \Image::make($request->image)->save(public_path('img/About/').$name);
        }
        return About::create(
            [
                'title' => $request['title'],
                'description' => $request['description'],
                'image' => $directory

            ]
        );
    }


    public function update(Request $request, $id)
    {
        $user = About::findOrFail($id);
        $this->validate($request,[
            'title' => "required|string",
            'description' => "required",
        ]);
        $directory = "";
        if ($request->image){
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            $directory = "img/About/".$name;
            \Image::make($request->image)->save(public_path('img/About/').$name);
            File::delete($user->project_image);
            $request['image'] = $directory;
        }

        $user->update($request->all());
        return response()->json(['message'=>"Data Updated"]);
    }


    public function destroy($id)
    {

        $user = About::findOrFail($id);
        if ($user){
            File::delete($user->image);
            $user->delete();
            return response()->json('Deleted Successfully');
        }
        else{
            return response()->json('Failed to  delete');
        }
    }
}
