<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $blogId)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $blog = Blog::findOrFail($blogId);

        $comment = new Comment();
        $comment->content = $request->input('comment');
        $comment->user_id = auth()->user()->id;
        $comment->blog_id = $blog->id;

        $comment->save();

        return redirect()->route('blogs.show', $blog->slug)->with('success', 'Comment posted successfully.');
    }
    public function loadMoreComments(Request $request, $blogId){
    $skip = $request->get('skip', 0);
    $take = $request->get('take', 5);

    $comments = Comment::where('blog_id', $blogId)
        ->skip($skip)
        ->take($take)
        ->with('user')
        ->get();

    return response()->json(['comments' => $comments]);
}

}
