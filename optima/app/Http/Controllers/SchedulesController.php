<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $conference_id
     * @return \Illuminate\Http\Response
     */
    public function index(int $conference_id)
    {
        $schedules = Schedule::where('conference_id', $conference_id)->get();

        return view('admin.schedule.index', compact('schedules', 'conference_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $conference_id
     * @return \Illuminate\Http\Response
     */
    public function create(int $conference_id)
    {
        return view('admin.schedule.create')->with('conference_id', $conference_id);
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
            'event' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        Schedule::create([
            'event' => $request->event,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'conference_id' => $request->conference_id,
        ]);

        return redirect()->route('schedule.index', ['conference_id' => $request->conference_id]);
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
        $schedule = Schedule::where('id', $id)
            ->firstOrFail();

        return view('admin.schedule.edit', compact('schedule'));
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
            'event' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $schedule = Schedule::findOrFail($id);

        $schedule->update([
            'event' => $request->event,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'conference_id' => $request->conference_id,
        ]);

        return redirect()->route('schedule.index', ['conference_id' => $request->conference_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->delete();

        return redirect()->back();
    }
}
