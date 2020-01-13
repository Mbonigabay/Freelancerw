<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inbox()
    {
        if (Auth::check()) {
            $messages = Message::where('user_to', Auth::user()->id)->orderBy('id', 'desc')->get();

            return view('messages.inbox', ['messages' => $messages]);
        }
        return view('auth.login');
    }

    public function chat()
    {
        if (Auth::check()) {
            $messages = Message::where('user_to', Auth::user()->id)->orderBy('id', 'asc')->get();
            $messagis = Message::where('user_from', Auth::user()->id)->orderBy('id', 'asc')->get();
            return view('messages.chat', ['messages' => $messages, 'messagis' => $messagis]);
        }
        return view('auth.login');
    }

    public function sent()
    {
        if (Auth::check()) {
            $messages = Message::where('user_from', Auth::user()->id)->orderBy('id', 'desc')->get();

            return view('messages.sent', ['messages' => $messages]);
        }
        return view('auth.login');
    }

    public function archived()
    {
        if (Auth::check()) {
            $messages = Message::where('user_from', Auth::user()->id)->orWhere('user_to', Auth::user()->id)->where('status', 'archived')->orderBy('id', 'desc')->get();

            return view('messages.archive', ['messages' => $messages]);
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
        if (Auth::check()) {
            $messages = Message::orderBy('id', 'desc')->get();

            return view('messages.compose', ['messages' => $messages]);
        }
        return view('messages.compose');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function compose(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_to' => 'required',
            'message' => 'required',
            'subject' => 'required'
        ]);

        $email = $request->input('user_to');
        $user_from = Auth::user()->id;
        $user_to = User::where('email', $email)->first();
        $messages = Message::where('user_from', Auth::user()->id)->orderBy('id', 'desc')->get();
        if ($validator->passes()) {
            if (Auth::check()) {
                if ($user_to and $user_to != Auth::user()) {
                    $message = Message::create([
                        'user_from' => $user_from,
                        'user_to' => $user_to->id,
                        'body' => $request->input('message'),
                        'title' => $request->input('subject'),
                    ]);
                    if ($message) {
                        return redirect()->route('messages.sent', ['messages' => $messages])
                            ->with('success', 'Message sent ');
                    }
                }
                return back()->withInput()->with('error', 'Wrong Email');
            }
            return back()->withInput()->with('error', 'Error sending new message');
        }
        return back()
        ->withInput()
        ->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::where('id', $id)->first();
        $user_to = User::where('id', $message->user_to)->first();

        if ($user_to->id == Auth::id()) {
            $MessageUpdate = Message::where('id', $id)
                ->update([
                    'status' => 'read',
                ]);
            if ($MessageUpdate) {
                return view('messages.show', ['message' => $message]);
            }
        }
        return back()->with('error', 'Can\'t see the message');
    }

    public function unread($id)
    {
        $MessageUpdate = Message::where('id', $id)
            ->update([
                'status' => 'unread',
            ]);
        if ($MessageUpdate) {
            $messages = Message::where('user_to', Auth::user()->id)->orderBy('id', 'desc')->get();

            return redirect()->back()
                ->with('success', 'Message marked as not read successful');
        }
    }

    public function read($id)
    {
        $MessageUpdate = Message::where('id', $id)
            ->update([
                'status' => 'read',
            ]);
        if ($MessageUpdate) {
            $messages = Message::where('user_to', Auth::user()->id)->orderBy('id', 'desc')->get();

            return redirect()->back()
                ->with('success', 'Message marked as read successful');
        }
    }

    public function archive($id)
    {
        $MessageUpdate = Message::where('id', $id)
            ->update([
                'status' => 'archived',
            ]);
        if ($MessageUpdate) {
            $messages = Message::where('user_to', Auth::user()->id)->orderBy('id', 'desc')->get();

            return redirect()->back()
                ->with('success', 'Message archived successful');
        }
    }

    public function delete($id)
    {
        $MessageUpdate = Message::where('id', $id)
            ->update([
                'status' => 'deleted',
            ]);
        if ($MessageUpdate) {
            $messages = Message::where('user_to', Auth::user()->id)->orderBy('id', 'desc')->get();

            return redirect()->back()
                ->with('success', 'Message deleted successful');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
