<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('user')
            ->where('user_id', auth()->id())
            ->get();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog-thumbnail', 'public');
        }

        Blog::create($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog submitted for approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $validated['is_approved'] = 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog-thumbnail', 'public');
        }

        $blog->update($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog submitted for approval.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }

    public function toggleStatus(Blog $blog)
    {
        $blog->is_active = !$blog->is_active;
        $blog->save();
        return redirect()->route('blogs.index')->with('success', 'Blog status updated');
    }

    public function blogs()
    {
        $blogs = Blog::with('user')
            ->where('is_approved', true)
            ->where('is_active', true)
            ->get();
        return view('web.blogs', compact('blogs'));
    }

    public function showBlog(Blog $blog)
    {
        return view('web.show', compact('blog'));
    }
}
