<?php

namespace App\Http\Controllers;

use App\Job;
use App\Message;
use App\User;
use Validator;
use DB;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class jobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Job::paginate(5)->pluck('skills');
        if (Auth::check()) {
            $jobs = Job::where('bidDeadline', '>', today())
            ->orderBy('id', 'desc')->get();

            return view('jobs.index', ['jobs' => $jobs, 'cat' => $cat]);
        }
        return view('auth.login');
    }

    public function viewByUser($id)
    {
        $jobs = Job::where('user_id', $id)->orderBy('id', 'desc')->get();

        return view('users.viewmyjob', ['jobs' => $jobs]);

    }


    public function search(Request $request)
    {
        $search = $request->get('search');
        $user = User::where('name', 'like' , '%' . $search . '%')->first();
        if ($user) {
            $jobs = DB::table('jobs')->where('skills', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('location', 'like', '%' . $search . '%')
                ->orWhere('user_id', 'like', '%' . $user->id . '%')
                ->get();
        } else {
            $jobs = DB::table('jobs')->where('skills', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('location', 'like', '%' . $search . '%')
                ->get();
        }
        return view('jobs.index')->with('jobs', $jobs);
    }

    public function autoComplete(Request $request)
    {
        $data = Item_model::select("skills")
            ->where("skills", "LIKE", "%{$request->input('search')}%")
            ->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $jobs = Job::orderBy('id', 'desc')->get();

            return view('jobs.create', ['jobs' => $jobs]);
        }
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'jobBudget' => 'required',
            'description' => 'required',
            'skills' => 'required',
            'deadline' => 'required',
            'bidDeadline' => 'required|date|before:deadline',
        ]);

        if ($validator->passes()) {
            if (Auth::check()) {
                $job = Job::create([
                    'name' => $request->input('name'),
                    'jobBudget' => $request->input('jobBudget'),
                    'description' => $request->input('description'),
                    'skills' => $request->input('skills'),
                    'location' => $request->input('location'),
                    'deadline' => $request->input('deadline'),
                    'bidDeadline' => $request->input('bidDeadline'),
                    'user_id' => Auth::user()->id
                ]);
                if ($job) {
                    return redirect()->route('jobs.show', ['job' => $job->id])
                        ->with('success', 'Job created successfully');
                }

            }
        }

        return back()
            ->withInput()
            ->withErrors($validator);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Job $job
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $id = Auth::user()->id;
        $job = Job::where('id', $id)->first();
//        $job = Job::with('users')->find($id);

        return view('jobs.show', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job $job
     * @return \Illuminate\Http\Response
     */
    public function edit($job_id)
    {
        $job = Job::findOrFail($job_id);
        if (Auth::user()->id == $job->user_id) {
            return view('jobs.edit', ['job' => $job]);
        }
        return back()->with('error', 'Not allowed such function');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Job $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'jobBudget' => 'required',
            'description' => 'required',
            'skills' => 'required',
            'location' => 'required',
            'deadline' => 'required',
            'bidDeadline' => 'required|date|before:deadline',
        ]);

        if ($validator->passes()) {
            if (Auth::check()) {
                $jobUpdate = Job::where('id', $id)
                    ->update([
                        'name' => $request->input('name'),
                        'jobBudget' => $request->input('jobBudget'),
                        'description' => $request->input('description'),
                        'skills' => $request->input('skills'),
                        'status' => $request->input('status'),
                        'location' => $request->input('location'),
                        'deadline' => $request->input('deadline'),
                        'bidDeadline' => $request->input('bidDeadline'),
                    ]);

                if ($jobUpdate) {


                    $job = Job::where('id', $id)->first();
                    return redirect()->route('jobs.show', ['job' => $job])
                        ->with('success', 'Job updated successful');
                }
            }
        }

        return back()
            ->withErrors($validator)
            ->withInput();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        if ($job) {
            $job->delete();
            return redirect()->route('jobs.index')
                ->with('success', 'Job deleted successfully');
        }

        return back()->withInput()->with('error', 'Job could not be deleted');

    }

    public function delete($id)
    {
        if (Auth::check()) {
            $jobUpdate = Job::where('id', $id)
                ->update([
                    'status' => 'deleted',
                ]);

            if ($jobUpdate) {
                $jobs = Job::orderBy('id', 'desc')->get();
                return redirect()->route('jobs.index', ['jobs' => $jobs])
                    ->with('success', 'Job deleted successful');
            }
        }
    }

    public function adduser(Request $request)
    {
        //add user to jobs
        //take a job, add a user to it

        $job = Job::find($request->input('job_id'));
        $user = User::find($request->input('user_id'));

        if ($job) {
            $job->users()->attach($user->id);
            Message::create([
                'user_from' => Auth::user()->id,
                'user_to' => $job->user_id,
                'body' => 'i have placed a bid on a job :< ' . $job->name . ' > you posted.',
                'title' => 'Notification',
            ]);
            return redirect()->route('jobs.show', ['job' => $job->id])
                ->with('success', 'Job bid successful');

        }
        return redirect()->route('jobs.show', ['job' => $job->id])
            ->with('error', 'Error adding user to job');
    }


    /**
     * @param Request $request
     * @param Job $job
     */
    public function accept($job_id, $user_id)
    {
        $job = Job::findOrFail($job_id);

        $job->users()->updateExistingPivot($user_id, [
            'status' => 'accepted'
        ]);
        Message::create([
            'user_from' => Auth::user()->id,
            'user_to' => $user_id,
            'body' => 'i have accepted a bid placed on a job :< ' . $job->name . ' >',
            'title' => 'Notification',
        ]);
        return redirect()->back()
            ->with('success', 'bid accepted successful');

    }

    public function decline($job_id, $user_id)
    {
        $job = Job::findOrFail($job_id);
        $job->users()->updateExistingPivot($user_id, [
            'status' => 'denied'
        ]);
        Message::create([
            'user_from' => Auth::user()->id,
            'user_to' => $user_id, Auth::user()->id,
            'body' => 'i have denied a bid placed on a job :< ' . $job->name . ' >',
            'title' => 'Notification',
        ]);

        return redirect()->back()
            ->with('success', 'Bid denied successful');


    }

    public function downloadJob($id){
        $job = Job::find($id);

        $pdf = PDF::loadView('jobs.downloadjob', compact('job'));
        return $pdf->download($job->name.'.pdf');

    }

}
