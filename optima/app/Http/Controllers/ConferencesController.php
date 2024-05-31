<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ConferencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeConference = Conference::where('isActive', true)->first();

        if ($activeConference) {
            $topics = $activeConference->topics()->get();
            $schedules = $activeConference->schedules()->get();

            $isActiveConference = Conference::where('isActive', true)->exists();

            return view('conference', compact(
                'activeConference', 'topics', 'schedules', 'isActiveConference'
            ));
        } else {
            return redirect(RouteServiceProvider::DASHBOARD);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.conference.create');
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
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        Conference::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        return redirect()->route('conference.admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conference = Conference::where('id', $id)
            ->firstOrFail();

        return view('admin.conference.edit', compact('conference.index'));
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
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $conference = Conference::findOrFail($id);

        $conference->update([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        return redirect()->route('conference.admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conference = Conference::findOrFail($id);

        $conference->topics->each(function ($topic) {
            if ($topic->image_path && File::exists(public_path('images/topics/' . $topic->image_path))) {
                File::delete(public_path('images/topics/' . $topic->image_path));
            }
            
            $topic->delete();
        });

        $conference->delete();

        return redirect()->back();
    }

    /**
     * Show table of conferences.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $conferences = Conference::all();

        $isActiveConference = Conference::where('isActive', true)->exists();

        return view('admin.conference.index', compact('conferences', 'isActiveConference'));
    }


    /**
     * Set a conference active by ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setActiveById(Request $request)
    {
        $request->validate([
            'conference_id' => 'required|exists:conferences,id'
        ]);

        $conference = Conference::findOrFail($request->conference_id);
        Conference::where('isActive', true)->update(['isActive' => false]);
        $conference->update(['isActive' => true]);

        return redirect()->back();
    }

    /**
     * Set a conference inactive by ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setInactiveById(Request $request)
    {
        $conference = Conference::findOrFail($request->conference_id);
        $conference->update(['isActive' => false]);

        return redirect()->back();
    }
}
