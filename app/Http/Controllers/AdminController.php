<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('user.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect(route('user.create'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return redirect(route('user.show',$id));
    }

    public function edit($id)
    {
        return redirect(route('user.edit',$id));
    }

    public function update(Request $request, $id)
    {  
        return abort(403,"mauvais appel d\'action");
        // return redirect(route('user.update',[$id,$request]));
    }

    public function destroy($id)
    {
        //
    }
}
