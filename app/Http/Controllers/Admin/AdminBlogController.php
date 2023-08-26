<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Validator;
use Session;
use Storage;
use Hash;
use App\Models\Blog;
use Carbon\Carbon;

class AdminBlogController extends Controller
{
    public function getBlogs() {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('admin.blogs', compact('blogs'));
    }

    public function saveBlog(Request $request) {
        $validator = $this->validateBlog($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $blog = new Blog();
        $blog->title   = $request->title;
        $blog->slug    = $request->slug;
        $blog->excerpt = $request->excerpt;
        $blog->body    = $request->body;
        $blog->save();

        if ($blog) {
            return response()->json([
                'message' => 'Blog created successfully',
                'code'    => '200'
            ]);
        }
    }

    public function updateBlog(Request $request){

        $validator = $this->validateBlog($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $blog = Blog::where('id', (int)$request->id)
                ->update([
                     'title'   => $request->title,
                     'slug'    => $request->slug,
                     'excerpt' => $request->excerpt,
                     'body'    => $request->body,
                ]);

        if ($blog) {
            return response()->json([
                'message' => 'Blog updated successfully',
                'code'    => '200'
            ]);
        }
    }

    public function getBlogById(Request $request) {
        $blog = Blog::where('id', (int)$request->id)
                ->orderBy('created_at', 'desc')
                ->first();

        $response = [
            'blog' => $blog
        ];

        return response()->json($response);
    }

    public function deleteBlog(Request $request){
        $id = (int) $request->id;
        $blog = Blog::where('id', $id)->delete();

        if ($blog) {
            return response()->json([
                'message' => 'Blog deleted successfully',
                'code'    => '200'
            ]);
        }
    }

    public function validateBlog($request) {
         $rules = [
            'title'   => 'required|string',
            'slug'    => 'required|string',
            'excerpt' => 'required|string',
            'body'    => 'required|string|max:1000',
        ];

        return $validator = Validator::make($request->all(), $rules);
    }

}
