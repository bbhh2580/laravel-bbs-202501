<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ReplyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $replies = Reply::whereNull('parent_id')->with('children')->latest()->get();
        return view('replies.index', compact('replies'));
    }

    /**
     * Store a reply for the topic.
     *
     * @param ReplyRequest $request
     * @param Reply $reply
     * @return RedirectResponse
     */
    public function store(ReplyRequest $request, Reply $reply): RedirectResponse
    {
        $reply->message = $request->message;
        $reply->user_id = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->save();

        return redirect()->to($reply->topic->slug . '#reply' . $reply->id)->with('success', 'Reply created successfully.');
    }

    // 处理子回复存储
    public function storeReply(Request $request, Reply $reply)
    {
//        dd($request->all()); // 这行用于调试
        $request->validate([
            'message' => 'required|min:2',
        ]);

        Reply::create([
            'topic_id' => $reply->topic_id, // 继承父级回复的话题ID
            'user_id' => Auth::id(),
            'message' => $request->input('message'),
            'parent_id' => $reply->id, // 记录父级回复
        ]);

        return back()->with('success', 'Reply added successfully.');
    }

    /**
     * Delete the reply.
     *
     * @param Reply $reply
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Reply $reply): RedirectResponse
    {
        $this->authorize('destroy', $reply);
        $reply->delete();

        return redirect()->to($reply->topic->slug)->with('success', 'Deleted successfully.');
    }
}
