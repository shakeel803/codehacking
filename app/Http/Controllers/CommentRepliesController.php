<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CommentReplyRequest;
use App\CommentReply;
use Auth;
use Session;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $replies = CommentReply::all();
        //return $replies;
        return view('admin.comments.replies.index', compact('replies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function createReply(CommentReplyRequest $request)
    {
        $user = Auth::user();
        $data = array(

            'post_id' => $request->post_id,
            'author' => $user->name,
            'comment_id'=>$request->comment_id,
            'email' => $user->email,
            'photo' => $user->photo->file,
            'body' => $request->body

        );
        CommentReply::create($data);
        $request->session()->flash('msg','Your reply has been submitted for moderation.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $replies = CommentReply::whereCommentId($id)->get();
        return view('admin.comments.replies.show',compact('replies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $reply = CommentReply::findOrFail($id);
        $reply->update($request->all());
        if($request->is_active)
            $request->session()->flash('msg','Reply approved');
        else
            $request->session()->flash('msg','Reply un-approved');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CommentReply::findOrFail($id)->delete();
        Session::flash('msg','Reply has been deleted');
        return redirect()->back();
    }
}
