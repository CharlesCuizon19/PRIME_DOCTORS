<?php

namespace App\Http\Controllers;

use App\Models\BlogCategories;
use App\Models\Blogs;
use App\Models\Files;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogsController extends Controller
{
    /**
     * Display all blogs.
     */
    public function index()
    {
        $blogs = Blogs::with('category')->orderBy('created_at', 'desc')->get();
        $categories = BlogCategories::orderBy('category_name')->get();
        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        $blogcategories = BlogCategories::all();
        return view('admin.blogs.create', compact('blogcategories'));
    }

    /**
     * Store a newly created blog.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'context'       => 'required|string',
            'blog_date'     => 'required|date',
            'category_name' => 'required|string|max:255',
            'blog_image_id'    => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = BlogCategories::firstOrCreate(['category_name' => $request->category_name]);

        $blog_image_id = null;

        if ($request->hasFile('blog_image_id')) {
            $file = $request->file('blog_image_id');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/blogs'), $filename);
            $filePath = 'storage/blogs/' . $filename;

            $fileModel = Files::create(['image_path' => $filePath]);
            $imageModel = Images::create([
                'file_id' => $fileModel->id,
                'uploaded_by_id' => auth()->id(),
                'alt_text' => $request->title,
            ]);

            $blog_image_id = $imageModel->id;
        }

        Blogs::create([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'context'       => $request->context,
            'blog_date'     => $request->blog_date,
            'category_id'   => $category->id,
            'uploaded_by_id' => auth()->id(),
            'blog_image_id' => $blog_image_id, // can be null if no image
        ]);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    /**
     * Show the form for editing a blog.
     */
    public function edit($id)
    {
        $blog = Blogs::findOrFail($id);
        $blogcategories = BlogCategories::orderBy('category_name')->get();
        return view('admin.blogs.edit', compact('blog', 'blogcategories'));
    }

    /**
     * Update an existing blog.
     */
    public function update(Request $request, $id)
    {
        $blog = Blogs::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'context' => 'required|string',
            'blog_date' => 'required|date',
            'category_id' => 'required|exists:blog_categories,id',
            'blog_image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog_image_id = $blog->blog_image_id; // keep existing image by default

        // Handle new blog image upload
        if ($request->hasFile('blog_image')) {
            $file = $request->file('blog_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/blogs'), $filename);
            $filePath = 'storage/blogs/' . $filename;

            // Create file and image records
            $fileModel = Files::create(['image_path' => $filePath]);
            $imageModel = Images::create([
                'file_id' => $fileModel->id,
                'uploaded_by_id' => auth()->id(),
                'alt_text' => $validated['title'],
            ]);

            $blog_image_id = $imageModel->id; // update blog image id
        }

        // Update blog
        $blog->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'context' => $validated['context'],
            'blog_date' => $validated['blog_date'],
            'category_id' => $validated['category_id'], // use category_id like store
            'blog_image_id' => $blog_image_id, // new or existing image
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }

    /**
     * Delete a blog.
     */
    public function destroy($id)
    {
        $blog = Blogs::findOrFail($id);
        $blog->delete();

        return redirect()->back()->with('success', 'Blog deleted successfully');
    }
}
