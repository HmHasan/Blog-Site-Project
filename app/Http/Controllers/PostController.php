<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();
        return view('pages/post.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/post.create');
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
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'mimes:jpg,jpeg,png,webp,gif|nullable|max:1999',
        ]);

if($request->hasFile('cover_image'))
{
    //get file name with extension
    $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
    //get just file name
    $filename = pathinfo($fileNameWithExt.PATHINFO_FILENAME);
    // dd($filename);
    // exit;
    //get just extension
    $extension = $request->file('cover_image')->getClientOriginalExtension();
    //File Name to Store

    $fileNametoStore = $filename['filename'].'_'.time().'.'.$extension;

    //upload image
    $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNametoStore);
}

else
{
    $fileNametoStore = 'noimage.jpg';
}

            $post = new Post();
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->user_id = auth()->user()->id;
            $post->cover_image = $fileNametoStore;
            $post->save();
            return redirect('/posts')->with('success','New Post Seccessfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::Find($id);


      if($post){
        return view('pages/post.show')->with('post',$post);
      }
      else{
        return abort(404);
      }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);


       if(auth()->user()->id != $post->user_id)
        {
            return redirect('/posts')->with('error','un athorize Page');
        }
        else{
            return view('pages/post.edit')->with('post',$post);
        }

        // else

        // {
        //     return abort(404);
        // }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999',
        ]);

if($request->hasFile('cover_image'))
{
    //get file name with extension
    $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
    //get just file name
    $filename = pathinfo($fileNameWithExt.PATHINFO_FILENAME);
    // dd($filename);
    // exit;
    //get just extension
    $extension = $request->file('cover_image')->getClientOriginalExtension();
    //File Name to Store

    $fileNametoStore = $filename['filename'].'_'.time().'.'.$extension;

    //upload image
    $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNametoStore);
}

            $post = Post::find($id);
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            if($request->hasFile('cover_image'))
            {
                $post->cover_image = $fileNametoStore;
            }
            $post->save();

            return redirect('/posts')->with('success','Post Seccessfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post=Post::find($id);
        // if(auth()->user()->id != $post->user_id)
        // {
        //     return redirect('/posts')->with('error','un athorize Page');
        // }
        // else{
        //     return view('pages/post.edit')->with('post',$post);
        // }

        if($post->cover_image != 'noimage.jpg')
        {
            //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);

        }
        $post->delete();
        return redirect('/posts')->with('success','Post Seccessfully Deleted');




    }
}
