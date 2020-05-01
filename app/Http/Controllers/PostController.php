<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use Log;
use View;
use Illuminate\Support\Facades\Gate;
use App\Category;

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
        Gate::authorize('create-post');
        $categories = Category::all();
    	return view('post', ['categories' => $categories]);
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
        $postCategories = $request->input('postCategories');

        if( !empty($postCategories) ){
            $postCategories = serialize($postCategories);
        } else {
            $postCategories = '';
        }

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
    		'image' => $image,
            'categories' => $postCategories
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

        Gate::authorize('delete-post', $post);

        $postImg = $post->image;

        $post->delete();

        if( !empty($postImg) ){
            $postImgPath = public_path('/images/posts/' . $postImg);

            if( file_exists($postImgPath) ){
                unlink($postImgPath);
            }
        }

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

        $categories = $post->categories;

        if( !empty($categories) ){
            $categories = unserialize($categories);
        } else {
            $categories = [];
        }

        $allCategories = Category::all();

        return view('edit_post', ['post' => $post, 'categories' => $categories, 'allCategories' => $allCategories]);
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

        Gate::authorize('update-post', $post);

        $postTitle = $request->input('title');
        $postExcerpt = $request->input('excerpt');
        $postContent = $request->input('content');
        $postOldImage = $request->input('postImage');
        $postNewImage = $request->file('image');

        $postCategories = $request->input('postCategories');

        if( !empty($postCategories) ){
            $postCategories = serialize($postCategories);
        } else {
            $postCategories = '';
        }

        $postImageRemoved = $request->input('removedImage');

        if( !empty($postImageRemoved) ){
            $removeImgPath = public_path('/images/posts/' . $postImageRemoved);
            if( file_exists($removeImgPath) ){
                unlink($removeImgPath);
            }
        }

        if( is_null($postOldImage) ){
            $image = '';
        } else {
            $image = $postOldImage;
        }

        if( !empty($postNewImage) ){
            if( $postNewImage->isValid() ){
                $imageName = $postNewImage->getClientOriginalName();
                $imageExtension = $postNewImage->extension();
                $imagePath = $postNewImage->path();

                if( file_exists( public_path('/images/posts/' . $imageName) ) ){
                    $random = rand(1, 10000);
                    $imgName = pathinfo($imageName, PATHINFO_FILENAME);
                    $img = $imgName . $random . '.' . $imageExtension;
                    $storePostImage = $postNewImage->move( public_path('/images/posts/'), $img );
                    $image = $img;
                } else {
                    $storePostImage = $postNewImage->move( public_path('/images/posts/'), $imageName );
                    $image = $imageName;
                }

                if( !empty($postOldImage) ){
                    $imgPath = public_path('/images/posts/' . $postOldImage);
                    // remove old image from storage
                    if( file_exists( $imgPath ) ){
                        // delete image
                        unlink( $imgPath );
                    }
                }
            }
        }

        $updatedAt = date("Y-m-d h:i:sa");

        $post->title = $postTitle;
        $post->excerpt = $postExcerpt;
        $post->content = $postContent;
        $post->image = $image;
        $post->updated_at = $updatedAt;
        $post->categories = $postCategories;

        $post->save(); 

        $request->session()->flash('postUpdated', 'You have successfully updated Post.');

        return redirect()->route('post.edit', ['id' => $postID]);
    }
}
