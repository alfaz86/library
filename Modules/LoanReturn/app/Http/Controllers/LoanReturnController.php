<?php

namespace Modules\LoanReturn\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoanReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('loan-return::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loan-return::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('loan-return::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('loan-return::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
