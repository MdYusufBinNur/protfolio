<?php

namespace MyProfile\Http\Controllers\Api;

use Illuminate\Support\Facades\File;
use MyProfile\Http\Controllers\Controller;
use MyProfile\Models\ProjectCategory;
use MyProfile\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    public function index()
    {
        $projects = Projects::latest()->paginate(10);
        $categories = ProjectCategory::all();
        return compact('projects','categories');
    }


    public function store(Request $request)
    {


        //return $request->photo;
        $this->validate($request,[
            'project_name' => "required|string",
            'project_client' => "required|string|max:191",
            'project_date' => "required",
            'project_links' => "required",
            'project_image' => "required"
        ]);
        $directory = "";
        if ($request->project_image){
            $name = time().'.' . explode('/', explode(':', substr($request->project_image, 0, strpos($request->project_image, ';')))[1])[1];
            $directory = "img/Projects/".$name;
            \Image::make($request->project_image)->save(public_path('img/Projects/').$name);
        }
        return Projects::create(
            [
                'project_category_id' => $request['project_category_id'],
                'project_name' => $request['project_name'],
                'project_client' => $request['project_client'],
                'project_details' => $request['project_details'],
                'project_links' => $request['project_links'],
                'project_date' => $request['project_date'],
                'project_comments' => $request['project_comments'],
                'project_rating' => $request['project_rating'],
                'project_image' => $directory,

            ]
        );
    }


    public function update(Request $request, $id)
    {
        $user = Projects::findOrFail($id);
        $this->validate($request,[
            'project_name' => "required|string",
            'project_client' => "required|string|max:191",
            'project_date' => "required",
            'project_links' => "required",
        ]);
        $directory = "";
        if ($request->project_image){
            $name = time().'.' . explode('/', explode(':', substr($request->project_image, 0, strpos($request->project_image, ';')))[1])[1];
            $directory = "img/Projects/".$name;
            \Image::make($request->project_image)->save(public_path('img/Projects/').$name);
            File::delete($user->project_image);
            $request['project_image'] = $directory;
        }

        $user->update($request->all());
        return response()->json(['message'=>"Data Updated"]);
    }


    public function destroy($id)
    {

        $user = Projects::findOrFail($id);
        if ($user){
            File::delete($user->project_image);
            $user->delete();
            return response()->json('Deleted Successfully');
        }
        else{
            return response()->json('Failed to  delete');
        }

    }
}
