<?php

namespace App\Http\Controllers;
use willvincent\Rateable\Rateable;

use App\User;
use App\Job;
use App\Rating;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Image;
use PDF;
use DB;

class usersController extends Controller
{

    use Rateable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::check()) {
            $users = User::orderBy('id', 'desc')->get();

            return view('users.index', ['users' => $users]);
        }
        return view('auth.login');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'description' => $request->input('description'),
                'skills' => $request->input('skills'),
                //'user_id'=>  Auth::user()->id
            ]);
            if ($user) {
                return view('users.show', ['user' => $user, 'photos' => $photos])
                    ->with('success', 'User created successfully');
            }
        }

        return back()->withInput()->with('error', 'Error creating new user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$user = User::where('id', $user->id)->first();
        $user = User::find($id);
        $photos = Photo::where('user_id', $id)->get();

        return view('users.show', ['user' => $user, 'photos' => $photos]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $userhttps://www.youtube.com/watch?v=bCBYJZ6QbUI
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->id == $id or Auth::user()->role_id ==1){
        $user = User::findOrFail($id);

        return view('users.edit', ['user' => $user]);}
        return back()->with('error', 'Can\'t update someone else\'s account' );
    }

    public function upload(Request $request)
    {
        $user = Auth::user();
        $photos = Photo::where('user_id', $user->id)->get();

        // Handle the user upload of avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return back()->with('success', 'User updated successful');
    }


        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photos = Photo::where('user_id', $id)->get();
        $userUpdate = User::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'telephone' => $request->input('telephone'),
                'address' => $request->input('address'),
                'rateOfPayment' => $request->input('rateOfPayment'),
                'areaOfExpertise' => $request->input('areaOfExpertise'),
                'description' => $request->input('description'),
                'sex' => $request->input('sex'),
                'maritalStatus' => $request->input('maritalStatus'),
                'educationBackground' => $request->input('educationBackground'),
                'workExperience' => $request->input('workExperience'),
                'skills' => $request->input('skills'),
                'dob' => $request->input('dob'),

            ]);

        if ($userUpdate) {

            $user = User::where('id', $id)->first();
//            return back()->with('success', 'User updated successful');
            return redirect()->route('users.show', ['user' => $user])
                ->with('success', 'User updated successful');
        }

        return back()->withInput();

    }

    public function updateStatus(Request $request, $id)
    {

        $photos = Photo::where('user_id', $id)->get();
        $status = $request->input('status');
        $user = User::find($id);

        $userUpdate = User::where('id', $id)
            ->update([
                'verify' => $request->input('verify'),
                'status' => $request->input('status'),
                'role_id' => $request->input('role'),

            ]);

        if ($status = 'blocked') {
            if ($user) {

                $user->ban();
            }
        }
        if ($status = 'active') {
            if ($user) {

                $user->unban();
            }
        }

        if ($userUpdate) {

            $user = User::where('id', $id)->first();
//            return back()->with('success', 'User updated successful');
            return redirect()->route('users.show', ['user' => $user])
                ->with('success', 'User updated successful');
        }

        return back()->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $findUser = User::find($user->id);
        if ($findUser->delete()) {

            //redirect
            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully');
        }
        return back()->withInput()->with('error', 'User could not be deleted');

    }

    public function downloadCv($id){
        $user = User::find($id);

        $pdf = PDF::loadView('users.downloadcv', compact('user'));
        return $pdf->download($user->name.'s CV.pdf');

    }

    public function userStar (Request $request, User $user) {
        $rating = new Rating;
        $rating->user_id = Auth::id();
        $rating->rating = $request->input('rating');
        $rating->rateable_type = 'App\User';
        $rating->rateable_id = $user->id;
        $user->ratings()->save($rating);
        return redirect()->back();
    }

    public function searchUser(Request $request)
    {
        $search = $request->get('search');

            $users = DB::table('users')->where('name', 'like', '%' . $search . '%')
                ->orWhere('areaOfExpertise', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('skills', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->get();

        return view('users.index')->with('users', $users);
    }

    public function viewMyBid($id)
    {
        $user = Auth::user();

        return view('users.viewmybid', ['user' => $user]);

    }
}
