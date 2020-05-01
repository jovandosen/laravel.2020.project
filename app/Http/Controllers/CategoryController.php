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

    /**
     * Delete Category record
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id 
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
    	$categoryID = (int) $id;

    	$category = Category::find($categoryID);

    	Gate::authorize('delete-category', $category);

    	$category->delete();

    	$request->session()->flash('categoryDeleted', 'You have successfully deleted Category.');

        return redirect()->route('category.list');
    }

    /**
     * Show form for editing Category
     *
     * @param  int  $id 
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$categoryID = (int) $id;

    	$category = Category::find($categoryID);

    	return view('category.edit_category', ['category' => $category]);
    }

    /**
     * Update Category details
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
    	$categoryID = (int) $id;

    	$category = Category::find($categoryID);

    	Gate::authorize('update-category', $category);

    	$categoryName = $request->input('name');
    	$categoryDescription = $request->input('description');

    	$updatedAt = date('Y-m-d h:i:sa');

    	$category->name = $categoryName;
    	$category->description = $categoryDescription;
    	$category->updated_at = $updatedAt;

    	$category->save();

    	$request->session()->flash('categoryUpdated', 'You have successfully updated Category.');

        return redirect()->route('category.edit', ['id' => $categoryID]);
    }
}
