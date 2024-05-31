<?php

namespace App\Http\Controllers;

use App\Exports\ParticipantsExport;
use App\Models\Conference;
use App\Models\Participant;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeConference = Conference::where('isActive', true)->first();

        $isActiveConference = $activeConference->isActive;
        $conferenceTitle = $activeConference->title;

        return view('participant', compact('isActiveConference', 'conferenceTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'link' => 'required|string',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $userId = Auth::id();

        $profile = Profile::where('user_id', $userId)->first();
        if (
            $profile->country === 'Country' || $profile->city === 'City'
            || $profile->degree === 'Degree' || $profile->country === 'Institution'
        ) {
            return redirect()->back()
                ->withErrors(['registration' => 'Please fill in all profile fields: Country, City, Degree, and Institution.'])
                ->withInput();
        }

        $activeConference = Conference::where('isActive', true)->first();

        $existingRegistration = Participant::where('user_id', $userId)
            ->where('conference_id', $activeConference->id)
            ->count();

        if ($existingRegistration > 1) {
            return redirect()->back()
                ->withErrors(['registration' => 'You have already registered for this conference'])
                ->withInput();
        }

        Participant::create([
            'subject' => $request->input('subject'),
            'link' => $request->input('link'),
            'user_id' => $userId,
            'conference_id' => $activeConference->id
        ]);

        return redirect()->route('profile.index')
            ->with('success', 'Successfully registered!');
    }

    /**
     * Show table of participants.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $query = Participant::with(['conference', 'user']);

        $userParticipants = $query->paginate(10); // Paginate the results, 10 per page

        $isActiveConference = Conference::where('isActive', true)->exists();

        return view('admin.participant.index', compact('isActiveConference', 'userParticipants'));
    }

    /**
     * Export participants to a Excel file.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function exportParticipantsToExcel(Request $request)
    {
        $isActive = $request->query('isActive');
        $filename = "participants_" . date('Ymd_His') . ".xlsx";

        return Excel::download(new ParticipantsExport($isActive), $filename);
    }
}
