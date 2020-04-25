<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use Log;

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
     * @param  \Illuminate\Http\Request  $request
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
                $storePostImage = $postImage->store('posts');
                $image = $imageName;
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
}
