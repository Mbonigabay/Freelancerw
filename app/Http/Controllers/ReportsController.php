<?php

namespace App\Http\Controllers;

use App\Report;
use App\User;
use Auth;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment_list = [
            [
                'title' => 'Comment reported',
                'entries' => Report::where('reporteable_type', 'App\Comment')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->distinct()
                    ->get(),
            ],


        ];

        $job_list = [
            [
                'title' => 'Job reported',
                'entries' => Report::where('reporteable_type', 'App\Job')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->distinct()
                    ->get(),
            ],
        ];


        $user_list = [
            [
                'title' => 'User reported',
                'entries' => Report::where('reporteable_type', 'App\User')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->distinct()
                    ->get(),
            ],
        ];
        return view('reports.index', compact('comment_list', 'job_list', 'user_list'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reporter = Auth::user()->id;
        $reported = $request->input('reported');
        if (Auth::check()) {
            $report = Report::create([
                'reporter' => $reporter,
                'reported' => $reported,
                'body' => $request->input('body'),
                'title' => $request->input('title'),
                'reporteable_id' => $request->input('reporteable_id'),
                'reporteable_type' => $request->input('reporteable_type'),
            ]);
            if ($report) {
                return back()
                    ->with('success', 'Reported successfully');
            }
        }

        return back()->withInput()->with('error', 'Error reporting');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Report $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report $report
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::find($id);
        if ($report) {
            $report->delete();
            return back()
                ->with('success', 'Problem resolved');
        }

        return back()->withInput()->with('error', 'Job could not be deleted');
    }

    public function resolveUser($id)
    {
        $user = User::find($id);
        $report = Report::where('reporteable_id', $id)->first();

        if ($user) {
            $user->ban();
            $report->delete();
            return back()
                ->with('success', 'User ' . $user->name . ' is banned');
        }

        return back()->withInput()->with('error', 'user could not be banned');
    }
}
