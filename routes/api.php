<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResources(['user' => 'Api\UserController']);
Route::apiResources(['blog_categories' => 'Api\BlogCategoryController']);
Route::apiResources(['project_categories' => 'Api\ProjectCategoryController']);
Route::apiResources(['projects' => 'Api\ProjectsController']);
Route::apiResources(['abouts' => 'Api\AboutController']);
Route::apiResources(['job_details' => 'Api\JobDetailsController']);
Route::apiResources(['contacts' => 'Api\ContactController']);
Route::apiResources(['web' => 'Api\WebController']);

Route::get('/details/{id}','Api\WebController@details');
