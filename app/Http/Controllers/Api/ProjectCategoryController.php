<?php

namespace MyProfile\Http\Controllers\Api;

use MyProfile\Http\Controllers\Controller;
use MyProfile\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{

    public function index()
    {
        return ProjectCategory::latest()->paginate(10);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => "required|string|max:191"
        ]);

        return ProjectCategory::create(
            [
                'name' => $request['name']
            ]
        );
    }

    public function update(Request $request,$id)
    {
        $user = ProjectCategory::findOrFail($id);
        $this->validate($request,[
            'name' => "required|string|max:191",

        ]);
        $user->update($request->all());
        return response()->json(['message'=>"Data Updated"]);
    }

    public function destroy($id)
    {
        $blogCategory = ProjectCategory::findOrFail($id);
        if ($blogCategory){
            $blogCategory->delete();
            return response()->json('Deleted Successfully');
        }
        else{
            return response()->json('Failed to  delete');
        }
    }
}
