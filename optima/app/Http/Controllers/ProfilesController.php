<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Participant;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $isActiveConference = Conference::where('isActive', true)->exists();

        $userParticipants = Participant::with('conference')->where('user_id', Auth::id())->get();

        $conferenceCount = Participant::where('user_id', $user->id)
            ->distinct('conference_id')
            ->count('conference_id');

        $workCount = Participant::where('user_id', $user->id)->count();

        $lastConferenceDate = Participant::where('user_id', $user->id)
            ->join('conferences', 'participants.conference_id', '=', 'conferences.id')
            ->orderBy('conferences.start_date', 'desc')
            ->value('conferences.start_date');

        return view('profile', compact(
            'user',
            'isActiveConference',
            'userParticipants',
            'conferenceCount',
            'workCount',
            'lastConferenceDate'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();

        $isActiveConference = Conference::where('isActive', true)->exists();

        $conferenceCount = Participant::where('user_id', $user->id)
            ->distinct('conference_id')
            ->count('conference_id');

        $workCount = Participant::where('user_id', $user->id)->count();

        $lastConferenceDate = Participant::where('user_id', $user->id)
            ->join('conferences', 'participants.conference_id', '=', 'conferences.id')
            ->orderBy('conferences.start_date', 'desc')
            ->value('conferences.start_date');

        return view('profile.edit', compact(
            'user',
            'isActiveConference',
            'conferenceCount',
            'workCount',
            'lastConferenceDate'
        ));
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
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        list($country, $city) = explode(', ', $request->input('location'));

        $user->profile()->update([
            'degree' => $request->input('degree'),
            'institution' => $request->input('institution'),
            'country' => $country,
            'city' => $city,
        ]);

        return redirect()->route('profile.index')
            ->with('success', 'Profile updated successfully!');
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
