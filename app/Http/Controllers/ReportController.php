<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::paginate(15);
        return view('pages.admin.reports.index', compact('reports'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'trio_id' => 'required|exists:trios,id',
            'description' => 'max:255'
        ]);

        Report::create($request->only(['trio_id', 'description']));
    }

    public function destroy(Request $request, Report $report) {
        $report->delete();
        $request->session()->flash('message', 'Report has been deleted');
        return redirect()->action('ReportController@index');
    }
}
