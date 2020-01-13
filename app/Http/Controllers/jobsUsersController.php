<?php

namespace App\Http\Controllers;

use App\JobUser;
use Illuminate\Http\Request;
use DB;

class jobsUsersController extends Controller
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
    public function adduser(Request $request)
    {
        if(Auth::check()){
            $jobUser = JobUser::create([
                'user_id'=>  $request->input('user_id'),
                'job_id'=> $request->input('job_id'),
            ]);
            if($jobUser){
                return redirect()->route('jobs.show', ['job_id'])
                    ->with('success' , 'Bidded successfully');
            }
        }

        return back()->withInput()->with('error', 'Error creating new job');
    }

    public function jobUser(Request $request)
    {
        $jobId = $request->get('jobId');
        $jobs = DB::table('job_user')->where('job_id', 'like','%'.$jobId.'%')->paginate(5);
        return view('jobs.show', ['jobs' => $jobs]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobUser  $jobUser
     * @return \Illuminate\Http\Response
     */
    public function show(JobUser $jobUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobUser  $jobUser
     * @return \Illuminate\Http\Response
     */
    public function edit(JobUser $jobUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobUser  $jobUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobUser $jobUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobUser  $jobUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobUser $jobUser)
    {
        //
    }
}
