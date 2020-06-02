<?php

namespace MyProfile\Http\Controllers\Api;

use MyProfile\Http\Controllers\Controller;
use MyProfile\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BlogCategory::latest()->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $this->validate($request,[
            'name' => "required|string|max:191"
        ]);

        return BlogCategory::create(
            [
                'name' => $request['name']
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \MyProfile\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \MyProfile\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MyProfile\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
        $user = BlogCategory::findOrFail($id);
        $this->validate($request,[
            'name' => "required|string|max:191",

        ]);
        $user->update($request->all());
        return response()->json(['message'=>"Data Updated"]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroy($id)
    {
        $blogCategory = BlogCategory::findOrFail($id);
        if ($blogCategory){
            $blogCategory->delete();
            return response()->json('Deleted Successfully');
        }
        else{
            return response()->json('Failed to  delete');
        }
    }
}
