<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::orderBy('created_at', 'desc')->get();     //or "asc"
        return view('profiles.index')->with('profiles', $profiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if (!$user->profiles) {
            return view('profiles.create');
        } else {
            // return redirect()->route('e-dashboard');
            return redirect()->route('e-dashboard')->with('error', 'Already have a profile');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'company' => 'required',
            'address' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image')){
            //Get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }


        // Create Profile
        $profile = new Profile;
        $profile->phone = $request->input('phone');
        $profile->gender = $request->input('gender');
        $profile->age = $request->input('age');
        $profile->company = $request->input('company');
        $profile->address = $request->input('address');
        $profile->user_id = auth()->user()->id;
        $profile->cover_image = $fileNameToStore;
        $profile->save();

        // return View("/profiles/{{}}")->with('success', 'Profile Created');
        return redirect()->route('e-dashboard')->with('successs', 'Profile Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $profile = Profile::find($id);
        // $user = auth()->user();
        // $profile = $user->profiles;
        // return View('profiles.show')->with('profile', $profile);

        $profile = Profile::find($id);

        //Check for correct user
        if(auth()->user()->id == $profile->user_id ){
            return View('profiles.show')->with('profile', $profile);
        }
        elseif(auth()->user()->user_type == 'Administrator'){
            return View('profiles.show')->with('profile', $profile);
        }
        else{
            return redirect()->route('e-dashboard')->with('error', 'Unauthorized Page');
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
        $profile = Profile::find($id);

        //Check for correct user
        if(auth()->user()->id !== $profile->user_id){
            return redirect()->route('e-dashboard')->with('error', 'Unauthorized Page');
        }

        return View('profiles.edit')->with('profile', $profile);
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
        $this->validate($request, [
            'phone' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'company' => 'required',
            'address' => 'required',
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image')){
            //Get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }


        // ///DELETE this
        // $users = User::orderBy('created_at', 'desc')->get();     //or "asc"
        // $a=array('IDs');
        // foreach($users as $user){
        //     array_push($a,$user->id);
        // } 

        // Create Profile
        $profile = Profile::find($id);
        $profile->phone = $request->input('phone');
        $profile->gender = $request->input('gender');
        $profile->age = $request->input('age');
        $profile->company = $request->input('company');
        $profile->address = $request->input('address');
        $profile->user_id = auth()->user()->id;
        if($request->hasFile('cover_image')){
            $profile->cover_image = $fileNameToStore;
        }
        $profile->save();

        return redirect()->route('e-dashboard')->with('success', 'Profile Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $profile = Profile::find($id);

        // //Check for correct user
        // if(auth()->user()->id !== $profile->user_id){
        //     return redirect('/profiles')->with('error', 'Unauthorized Page');
        // }

        // if($profile->cover_image != 'noimage.jpg'){
        //     //Delete Image
        //     Storage::delete('public/cover_images/'.$profile->cover_image);
        // }

        // $profile->delete();
        // return redirect('/profiles')->with('success', 'Profile Deleted');
    }

    public function create_profile()
    {
        $profile = Null;
        return View('profiles.create-profile')->with('profile', $profile);
    }
}
