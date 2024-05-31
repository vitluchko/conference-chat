<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isActiveConference = Conference::where('isActive', true)->exists();

        $posts = Post::orderBy('updated_at', 'DESC')->get();

        return view('dashboard', compact('posts', 'isActiveConference'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $slug = SlugService::createSlug(Post::class, 'slug', $validatedData['title']);

        $newImageName = uniqid() . '-' . $slug . '.' .
            $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        $post = Post::create([
            'category' => $validatedData['category'],
            'title' => $validatedData['title'],
            'slug' => $slug,
            'image_path' => $newImageName,
            'description' => $validatedData['description'],
            'user_id' => auth()->id()
        ]);

        return redirect()->route('post.show', ['id' => $post->id, 'slug' => $slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        $post = Post::where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('dashboard.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $slug)
    {
        $post = Post::where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('admin.post.edit', compact('post'));
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
        $validatedData = $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:5048'
        ]);

        $post = Post::findOrFail($id);

        $slug = SlugService::createSlug(Post::class, 'slug', $validatedData['title']);

        if ($request->hasFile('image')) {
            $newImageName = uniqid() . '-' . $slug . '.' .
                $request->image->extension();

            $request->image->move(public_path('images'), $newImageName);

            if ($post->image_path && file_exists(public_path('images/' . $post->image_path))) {
                unlink(public_path('images/' . $post->image_path));
            }

            $post->image_path = $newImageName;
        }

        $post->category = $validatedData['category'];
        $post->title = $validatedData['title'];
        $post->slug = $slug;
        $post->description = $validatedData['description'];
        $post->user_id = auth()->id();
        $post->save();

        return redirect(RouteServiceProvider::DASHBOARD);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image_path && file_exists(public_path('images/' . $post->image_path))) {
            unlink(public_path('images/' . $post->image_path));
        }

        $post->delete();

        return redirect(RouteServiceProvider::DASHBOARD);
    }

    /**
     * Show table of posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $posts = Post::all();

        $isActiveConference = Conference::where('isActive', true)->exists();

        return view('admin.post.index', compact('posts', 'isActiveConference'));
    }
}
