<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
use Auth;
use Excel;

class PostController extends Controller
{
    /**
     * Display Posts List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $id = Auth::user()->id;
        $user_id = User::find($id);
        $countPerPage = config('constants.paginate_per_page');
        if ($user_id->type == '0') {
            $posts = Post::sortable()->paginate($countPerPage);
        } else {
            $posts = Post::where('create_user_id', '=' , $id)->paginate($countPerPage);
        }

        return view('posts/index',['name'=> 'Posts List'], compact('posts'));
    }

    /**
     * Create Post Form
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts/create',['name'=> 'Create Post']);
    }


    /**
     * Post Confirmation
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $post
     * @return \Illuminate\Http\Response
     */
    public function postConfirm(Request $request, Post $post)
    {  

        $validatedData = $request->validate([
            'title' => 'required|max:255|unique:posts,deleted_at',
            'description' => 'required',
            
        ]);
        
        $post = [
            'title' => $request->title,
            'description' => $request->description,
            'create_user_id' => Auth::user()->id,
        ];
        return view('posts.confirm', compact('post'));
    }

    /**
     * Post Data Store
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'create_user_id' => 'required',
            
        ]);
        
        Post::create($validatedData);
   
        return redirect('/post')->with('success', 'Post is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

     /**
     * Show the form for editing post
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts/edit',['name'=> 'Update Post'], compact('post'));
    }

    /**
     * Post Update Confirmation
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $post
     * @return \Illuminate\Http\Response
     */
    public function updateConfirm(Request $request,Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => '',
        ]);

        $status = $request->has('status') ? 1 : 0;

        $post = [
            'id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $status
        ];
        
        return view('posts/update_confirm',['name'=> 'Update Post Confirmation'], compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {   
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description =  $request->description;
        $post->status = $request->status;
        $post->updated_user_id =  $request->updated_user_id;
        $post->update();
        $post->save();
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->deleted_user_id = Auth::user()->id;
        $post->save();
        $delete = $post->delete();

        return redirect()->route('post.index')->with('success', 'Post has been Deleted');
    }

    /**
     * Search Function
     *
     * @return \Illuminate\Http\Response
     */
    public function postSearch()
    {   
        $countPerPage = config('constants.paginate_per_page');
        $search_text = $_GET['query'];
        $posts = Post::where("title","LIKE","%{$search_text}%")
                      ->orWhere("description","LIKE","%{$search_text}%")
                      ->paginate($countPerPage);

        return view('posts/search',compact('posts'))->with('search_text');
    }

    /**
     * Export Excel Function
     *
     * @return \Illuminate\Http\Response
     */
    public function exportIntoExcel()
    {   
        $file_name = "posts_" . date("m.d.y") . "_" . time() . ".xlsx";
        return Excel::download(new PostsExport, $file_name);
    }

    /**
     * Import Form
     *
     * @return \Illuminate\Http\Response
     */
    public function importForm()
    {
        return view('posts/import_form',['name'=> 'Upload CSV Form']);
    }

    /**
     * Import Function
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request) 
    {
        
        Excel::import(new PostsImport,request()->file('file'));
           
        return redirect()->route('post.index');
    }

}
