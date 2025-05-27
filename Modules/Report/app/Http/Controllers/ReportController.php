<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Book\Models\Book;
use Modules\Loan\Models\Loan;
use Modules\Member\Models\Member;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('report::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('report::create');
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
        return view('report::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('report::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}

    /**
     * Print the report.
     */
    public function print(Request $request, string $type)
    {
        app()->setLocale(session('locale', config('app.locale')));
        $start = $request->query('start');
        $end = $request->query('end');

        $reportData = collect();

        if ($type === 'member') {
            $reportData = Member::whereBetween('created_at', [$start, $end])->get();
        } elseif ($type === 'book') {
            $reportData = Book::whereBetween('created_at', [$start, $end])->get();
        } elseif ($type === 'loan') {
            $reportData = Loan::with('loan_returns')->whereBetween('created_at', [$start, $end])->get();
        }

        return view("report::filament.pages.print.{$type}", compact('reportData', 'start', 'end'));
    }
}
