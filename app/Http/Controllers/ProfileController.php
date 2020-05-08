<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use App\User;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PhoneNumberRequest;
use App\Phone;

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

    /**
     * Display form for Phone Number
     *
     * @return \Illuminate\Http\Response
     */
    public function phone()
    {
        $user = Auth::user()->phone;

        $phoneData = Phone::where("user_id", Auth::user()->id)->first();

        if( $phoneData ){
            $phoneID = $phoneData->id;
        } else {
            $phoneID = 0;
        }

        $data = [];
        
        if( !empty($user->phone) ){
            $userPhoneNumber = $user->phone;
            $title = '| Update Phone Number';
            $button = 'EDIT PHONE NUMBER';
            $action = route('update.phone.number', ['id' => $phoneID]);
            $data['userPhoneNumber'] = $userPhoneNumber;
            $data['title'] = $title;
            $data['button'] = $button;
            $data['action'] = $action;
            $data['id'] = $phoneID;
        } else {
            $userPhoneNumber = '';
            $title = '| Add Phone Number';
            $button = 'ADD PHONE NUMBER';
            $action = route('store.phone.number');
            $data['userPhoneNumber'] = $userPhoneNumber;
            $data['title'] = $title;
            $data['button'] = $button;
            $data['action'] = $action;
        }

        return View::make('profile.phone_number', ['data' => $data]);
    }

    /**
     * Store phone number in database
     *
     * @param  \App\Http\Requests\PhoneNumberRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function storePhoneNumber(PhoneNumberRequest $request)
    {
        // $phoneRecord = new Phone(['user_id' => Auth::user()->id, 'phone' => $request->input('phone')]);

        $phoneRecord = new Phone(['phone' => $request->input('phone')]);

        $user = Auth::user();

        $user->phone()->save($phoneRecord);

        $request->session()->flash('phoneNumberCreated', 'You have successfully added Phone Number.');

        return redirect()->route('phone.number');
    }

    /**
     * Update Phone Number
     *
     * @param  \App\Http\Requests\PhoneNumberRequest  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePhoneNumber(PhoneNumberRequest $request, $id)
    {
        $phoneID = (int) $id;

        $phone = Phone::find($phoneID);

        $phone->phone = $request->input('phone');

        $phone->save();

        $request->session()->flash('phoneNumberUpdated', 'You have successfully updated Phone Number.');

        return redirect()->route('phone.number');
    }

    /**
     * Delete Phone Number
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function deletePhoneNumber(Request $request, $id)
    {
        $phoneID = (int) $id;

        $phone = Phone::find($phoneID);

        $phone->delete();

        $request->session()->flash('phoneNumberDeleted', 'You have successfully deleted Phone Number.');

        return redirect()->route('phone.number');
    }
}
