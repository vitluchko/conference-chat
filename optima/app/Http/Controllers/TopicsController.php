<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Topic;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $conference_id
     * @return \Illuminate\Http\Response
     */
    public function index(int $conference_id)
    {
        $topics = Topic::where('conference_id', $conference_id)->get();

        $isActiveConference = Conference::where('isActive', true)->exists();

        return view('admin.topic.index', compact('topics', 'conference_id', 'isActiveConference'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $conference_id
     * @return \Illuminate\Http\Response
     */
    public function create(int $conference_id)
    {
        return view('admin.topic.create')->with('conference_id', $conference_id);
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
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $slug = SlugService::createSlug(Topic::class, 'slug', $request->name);

        $newImageName = uniqid() . '-' . $slug . '.' .
            $request->image->extension();

        $request->image->move(public_path('images/topics'), $newImageName);

        Topic::create([
            'name' => $request->name,
            'slug' => $slug,
            'image_path' => $newImageName,
            'description' => $request->description,
            'conference_id' => $request->conference_id,
        ]);

        $conference_id = $request->conference_id;

        return redirect()->route('topic.index', ['conference_id' => $conference_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = Topic::where('id', $id)
            ->firstOrFail();

        return view('admin.topic.edit', compact('topic'));
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
            'name' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:5048'
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $topic = Topic::findOrFail($id);

        $slug = SlugService::createSlug(Topic::class, 'slug', $request->name);

        if ($request->hasFile('image')) {
            $newImageName = uniqid() . '-' . $slug . '.' .
                $request->image->extension();

            $request->image->move(public_path('images/topics'), $newImageName);

            if ($topic->image_path && file_exists(public_path('images/topics/' . $topic->image_path))) {
                unlink(public_path('images/topics/' . $topic->image_path));
            }

            $topic->image_path = $newImageName;
        }

        $topic->name = $request->name;
        $topic->slug = $slug;
        $topic->description = $request->description;
        $topic->save();

        return redirect()->route('topic.index', ['conference_id' => $request->conference_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $topic = Topic::findOrFail($id);

        if ($topic->image_path && file_exists(public_path('images/topics/' . $topic->image_path))) {
            unlink(public_path('images/topics/' . $topic->image_path));
        }

        $topic->delete();

        return redirect()->back();
    }
}
