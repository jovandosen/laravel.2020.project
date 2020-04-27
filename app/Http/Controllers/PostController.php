<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use Log;
use View;

class PostController extends Controller
{
	/**
     * Create a new post controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display post list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return View::make('posts', ['posts' => $posts]);
    }

	/**
	 * Display post form for creating new Post
	 *
	 * @return \Illuminate\Http\Response 
	 */
    public function create()
    {
    	return view('post');
    }

    /**
     * Store a newly created Post in database
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
    	$userID = $request->input('userID');
    	$postTitle = $request->input('title');
    	$postExcerpt = $request->input('excerpt');
    	$postContent = $request->input('content');
    	$postImage = $request->file('image');

    	if( !empty($postImage) ){
    		if( $postImage->isValid() ){
    			$imageName = $postImage->getClientOriginalName();
                $imageExtension = $postImage->extension();
                $imagePath = $postImage->path();
                // $storePostImage = $postImage->store('posts');

                if( file_exists( public_path('/images/posts/' . $imageName ) ) ){
                    $random = rand(1, 10000);
                    $imgName = pathinfo($imageName, PATHINFO_FILENAME);
                    $img = $imgName . $random . '.' . $imageExtension;
                    $storePostImage = $postImage->move( public_path('/images/posts/'), $img );
                    $image = $img;
                } else {
                    $storePostImage = $postImage->move( public_path('/images/posts/'), $imageName );
                    $image = $imageName;
                }
    		}
    	} else {
    		$image = '';
    	}

    	$post = Post::create([
    		'userID' => $userID,
    		'title' => $postTitle,
    		'excerpt' => $postExcerpt,
    		'content' => $postContent,
    		'image' => $image
    	]);

    	if( $post ){
    		// Log post created
    		Log::info('New Post Created.');
    		// Flash message
    		$request->session()->flash('postCreated', 'You have successfully created Post.');
    		// redirect
    		return redirect()->route('post.show');
    	}

    }

    /**
     * Delete post
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $postID = (int) $id;

        $post = Post::find($postID);

        $post->delete();

        $request->session()->flash('postDeleted', 'You have successfully deleted Post.');

        return redirect()->route('post.list');
    }

    /**
     * Show form for post update
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $postID = (int) $id;

        $post = Post::find($postID);

        return view('edit_post', ['post' => $post]);
    }

    /**
     * Update Post data
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $postID = (int) $id;

        $post = Post::find($postID);

        var_dump($post);
    }
}
