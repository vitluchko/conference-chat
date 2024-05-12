<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $profile = $user->profile;

        return view('profile', compact('user', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Update the profile image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfileImage(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'id' => 'required|int',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $profile = Profile::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $newImageName = uniqid() . '-' . $profile->slug . '.' .
                $request->image->extension();

            $request->image->move(public_path('images/profiles'), $newImageName);

            if (
                $profile->profile_path &&
                file_exists(public_path('images/profiles/' . $profile->profile_path))
            ) {
                if ($profile->profile_path != 'default.jpg') {
                    unlink(public_path('images/profiles/' . $profile->profile_path));
                }
            }

            $profile->profile_path = $newImageName;
        }

        $profile->save();

        return response()->json([
            'status' => 'success',
            'profile_path' => asset('images/profiles/' . $newImageName)
        ]);
    }

    /**
     * Update the background image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateBackgroundImage(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'id' => 'required|int',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $profile = Profile::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $newImageName = uniqid() . '-' . $profile->slug . '.' .
                $request->image->extension();

            $request->image->move(public_path('images/profiles'), $newImageName);

            if (
                $profile->background_path &&
                file_exists(public_path('images/profiles/' . $profile->background_path))
            ) {
                if ($profile->background_path != 'background-default.jpg') {
                    unlink(public_path('images/profiles/' . $profile->background_path));
                }
            }

            $profile->background_path = $newImageName;
        }

        $profile->save();

        return redirect()->back();
    }
}
