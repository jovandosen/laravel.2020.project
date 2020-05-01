<?php

namespace App\Http\Controllers;

use View;
use Auth;
use Log;
use Gate;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
	/**
	 * Create new Category instance
	 *
	 * @return void
	 */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * Display form for new Category
     *
     * @return \Illuminate\Http\Response 
     */
    public function create()
    {
    	Gate::authorize('create-category');
    	return View::make('category.category');
    }

    /**
     * Store a newly created Category
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
    	$userID = $request->input('userID');
    	$categoryName = $request->input('name');
    	$categoryDescription = $request->input('description');

    	$userID = (int) $userID;

    	$category = Category::create([
    		'user_id' => $userID,
    		'name' => $categoryName,
    		'description' => $categoryDescription
    	]);

    	if( $category ){
    		Log::info('New Category Created.');
    		$request->session()->flash('categoryCreated', 'You have successfully created Category.');
    		return redirect()->route('category.show');
    	}
    }

    /**
     * Display Category List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$categories = Category::all();
    	return View::make('category.categories', ['categories' => $categories]);
    }
}
