<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Report;
use Auth;
use Validator;
use Illuminate\Http\Request;

class commentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'body' => 'required',
        ]);

        if ($validator->passes()) {
            if(Auth::check()){
                $comment = Comment::create([
                    'body' => $request->input('body'),
                    'commentable_type' => $request->input('commentable_type'),
                    'commentable_id' => $request->input('commentable_id'),
                    'user_id' => Auth::user()->id
                ]);
                if($comment){
                    return back()->with('success' , 'Comment created successfully');
                }
            }

        }

        return back()
            ->withErrors($validator)
            ->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $report = Report::where('reporteable_id', $id)->where('reporteable_type', 'App\Comment');
        if ($comment) {
            if($report) {
                $comment->delete();
                $report->delete();
            }
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully');
        }

        return back()->with('error', 'Comment could not be deleted');
    }
}
