<?php

namespace MyProfile\Http\Controllers\Api;

use MyProfile\Http\Controllers\Controller;
use MyProfile\Model\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return Contact::latest()->paginate(10);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => "required|string|max:191",
            'name' => "required|string|max:191",
            'email' => "required|string|max:191",
            'mobile' => "required|string|max:191",
            'message' => "required",
        ]);

        return Contact::create(
            [
                'name' => $request['name'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'message' => $request['message'],
                'title' => $request['title'],
            ]
        );
    }



    public function destroy($id)
    {
        $blogCategory = Contact::findOrFail($id);
        if ($blogCategory){
            $blogCategory->delete();
            return response()->json('Deleted Successfully');
        }
        else{
            return response()->json('Failed to  delete');
        }
    }
}
