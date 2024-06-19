<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('blog', compact('blog'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:blogs',
            'type' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'sections.*.title' => 'required|string|max:255',
            'sections.*.content' => 'required|string',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = substr(($request->input('title')), 0, 3) . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/images', $imageName);
        }

        $sections = [];

        if ($request->has('sections')) {
            foreach ($request->input('sections') as $section) {
                if (isset($section['title']) && isset($section['content'])) {
                    $sections[] = [
                        'title' => $section['title'],
                        'content' => $section['content']
                    ];
                }
            }
        }
        
        // dd($request->input('sections'));

        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->slug = Str::slug($request->input('title'));
        $blog->type = $request->input('type');
        $blog->content = json_encode($sections); 
        $blog->image = $imageName;
        $blog->user_id=Auth::user()->id; 
        $blog->save();

        return redirect('/admin/dashboard')->with('success', 'Blog post created successfully.');
    }


    public function index()
    {
        $user_id = auth()->user()->id;
        $blogs = Blog::where('user_id', $user_id)->get();
        // dd($blogs);
        return view('admin.dashboard', compact('blogs'));
    }

    public function edit($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        if (!$blog) {
            return redirect()->back()->with('error', 'Blog post not found.');
        }
        $types = ['Food blogs', 'Travel blogs', 'Health and fitness blogs','Technical', 'Lifestyle blogs', 'Fashion and beauty blogs', 'Photography blogs', 'Personal blogs', 'DIY craft blogs', 'Parenting blogs', 'Music blogs', 'Business blogs', 'Art and design blogs', 'Book and writing blogs', 'Personal finance blogs', 'Interior design blogs', 'Sports blogs', 'News blogs', 'Movie blogs', 'Religion blogs', 'Political blogs'];
        $blog->content = json_decode($blog->content, true);
        return view('edit_blog', compact('blog', 'types'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' =>'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $sections = [];
        foreach ($request->input('sections') as $section) {
            $sections[] = [
                'title' => $section['title'],
                'content' => $section['content']
            ];
        }
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $blog->title = $request->input('title');
        $blog->type = $request->input('type');
        $blog->content = $sections;

        // $blog->content = $request->input('content');
    
        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::delete('public/images/' . $blog->image);
            }
            $imageName = substr(($request->input('title')), 0, 3) . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/images', $imageName);
            $blog->image = $imageName;
        }

        $blog->save();
    
        return redirect('/admin/dashboard')->with('success', 'Blog post updated successfully.');
    }
    

    public function destroy($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        if ($blog->image) {
            Storage::delete('public/images/' . $blog->image);
        }
        $blog->delete();

        return redirect('/admin/dashboard')->with('success', 'Blog post deleted successfully.');
    }
}
