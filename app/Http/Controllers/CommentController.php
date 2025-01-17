<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, $restaurantId, $reviewId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        Comment::create([
            'review_id' => $reviewId,
            'user_id' => Auth::id(),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, $restaurantId, Comment $comment)
    {
        // Ensure the user is authorized to update the comment
        if (Auth::id() !== $comment->user_id && !Auth::user()->roles->contains('name', 'Pracownik')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $comment->update([
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy($restaurantId, Comment $comment)
    {
        // Ensure the user is authorized to delete the comment
        if (Auth::id() !== $comment->user_id && !Auth::user()->roles->contains('name', 'Pracownik')) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
