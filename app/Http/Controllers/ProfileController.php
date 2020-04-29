<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use App\User;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
	/**
	 * Create new Profile instance
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show profile form
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function profile()
    {
    	return View::make('profile.profile');
    }

    /**
     * Update profile data
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @param  int  $id
	 *
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
    	$userID = (int) $id;

    	$user = User::find($userID);

    	$userName = $request->input('name');
    	$userEmail = $request->input('email');
    	$userImage = $request->file('image');
    	$userOldImage = $request->input('userOldImage');
    	$userRemovedImage = $request->input('removedImage');

    	if( !empty($userImage) ){
    		if( $userImage->isValid() ){

    			$imageName = $userImage->getClientOriginalName();
                $imageExtension = $userImage->extension();
                $imagePath = $userImage->path();

                if( file_exists( public_path('/images/profile/' . $imageName) ) ){
                	$random = rand(1, 10000);
                    $imgName = pathinfo($imageName, PATHINFO_FILENAME);
                    $img = $imgName . $random . '.' . $imageExtension;
                    $storeUserImage = $userImage->move( public_path('/images/profile/'), $img );
                    $image = $img;
                } else {
                	$storeUserImage = $userImage->move( public_path('/images/profile/'), $imageName );
                	$image = $imageName;
                }

                if( !empty($userOldImage) ){
                	$imgOld = public_path('/images/profile/' . $userOldImage);

	                if( file_exists($imgOld) ){
	                	unlink($imgOld);
	                }
                }
    		}
    	} else {
    		if( is_null($userOldImage) ){
    			$image = '';
    		} else {
    			if( !empty($userRemovedImage) ){
    				if( file_exists( public_path('/images/profile/' . $userRemovedImage) ) ){
    					unlink( public_path('/images/profile/' . $userRemovedImage) );
    				}
    				$image = '';
    			} else {
    				$image = $userOldImage;
    			}
    		}
    	}

    	$updatedAt = date('Y-m-d h:i:sa');

    	$user->name = $userName;
    	$user->email = $userEmail;
    	$user->image = $image;
    	$user->updated_at = $updatedAt;

    	$user->save();

    	Auth::login($user, true);

    	$request->session()->flash('userProfileUpdated', 'You have successfully updated Profile.');

        return redirect()->route('profile');

    }
}
