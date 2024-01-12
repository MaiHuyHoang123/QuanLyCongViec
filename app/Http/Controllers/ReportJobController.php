<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;

class ReportJobController extends Controller
{
    //
    public function index() {
        $staffs = Staff::all();
        return view('report_job',compact('staffs'));
    }
}
