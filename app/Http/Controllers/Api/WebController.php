<?php

namespace MyProfile\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;
use MyProfile\Http\Controllers\Controller;
use MyProfile\Models\About;
use MyProfile\Models\JobDetails;
use MyProfile\Models\ProjectCategory;
use MyProfile\Models\Projects;

class WebController extends Controller
{
    public function index()
    {
        $about = About::latest()->first();
        $categories = ProjectCategory::with('projects')->latest()->get();
        $jobs = JobDetails::latest()->get();
        return compact('about','categories','jobs');
    }
    public function details($id)
    {
        return Projects::findOrFail($id);
    }
}
