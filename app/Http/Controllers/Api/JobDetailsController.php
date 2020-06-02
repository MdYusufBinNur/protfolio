<?php

namespace MyProfile\Http\Controllers\Api;

use MyProfile\Http\Controllers\Controller;
use MyProfile\Models\JobDetails;
use Illuminate\Http\Request;

class JobDetailsController extends Controller
{
    public function index()
    {
        return JobDetails::latest()->paginate(10);
    }


    public function store(Request $request)
    {
        //return $request->photo;
        $this->validate($request,[
            'title' => "required|string",
            'company' => "required|string|max:191",
            'time_line' => "required",
            'description' => "required",
        ]);

        return JobDetails::create(
            [
                'title' => $request['title'],
                'company' => $request['company'],
                'time_line' => $request['time_line'],
                'description' => $request['description']
            ]
        );
    }


    public function update(Request $request, $id)
    {
        $user = JobDetails::findOrFail($id);
//        $this->validate($request,[
//            'title' => $request['title'],
//            'company' => $request['company'],
//            'time_line' => $request['time_line'],
//            'description' => $request['description']
//        ]);

        $user->update($request->all());
        return response()->json(['message'=>"Data Updated"]);
    }


    public function destroy($id)
    {

        $user = JobDetails::findOrFail($id);
        if ($user){
            $user->delete();
            return response()->json('Deleted Successfully');
        }
        else{
            return response()->json('Failed to  delete');
        }

    }
}
