<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('user')
            ->get();
        return view('submitted-blogs.index', compact('blogs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('submitted-blogs.show', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $blog->update(['is_approved' => 1]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog approved successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }

    public function toggleStatus(Blog $blog)
    {
        $blog->is_active = !$blog->is_active;
        $blog->save();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog status updated');
    }
}
