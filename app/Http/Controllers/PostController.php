<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }






    public function upload(Request $request, Post $post)
    {

        if (! Gate::allows('upload-image', $post)) {
            abort(403);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public\images', $fileName);

            if ($path) {
                //enter the record images in database
                $post->images()->create([
                    'path'=>$fileName,
                ]);

                return response()->json([
                    'upload_status' => 'success'
                ], 200);
            } else {
                return response()->json([
                    'upload_status' => 'failed'
                ], 404);
            }
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
