<?php

namespace Modules\Contactus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Contactus\Entities\Contactus;

class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $messages=Contactus::all()->sortByDesc('created_at');
        return view('contactus::index',['messages' => $messages]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('contactus::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "fullname" => "string|required|min:3",
            "email" => "required|email",
            "message" => "required|string"
        ]);
        if(Contactus::insert($request->except('_token')))
            return back()->with('success','message sent successfully');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $message=Contactus::find($id);
        $message->is_read=1;
        $message->save();
        return view('contactus::show',['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('contactus::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        if(Contactus::find($id)->delete())
            return back();
    }
}
