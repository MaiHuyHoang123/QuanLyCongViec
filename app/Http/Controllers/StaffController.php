<?php

namespace App\Http\Controllers;

use App\Job;
use App\Staff;
use App\StaffImplementJob;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    // lấy tất cả các nhân viên hiện có
    public function getAllStaff()
    {
        $listStaff = Staff::all();
        return response()->json($listStaff);
    }
    // lấy nhân viên thực hiện job có id
    public function getStaffImplementJob(string $id)
    {
        $staffImplementJob = StaffImplementJob::where('job_id', $id)->first();
        $listStaffImplementJob = [];
        if ($staffImplementJob) {
            $idStaffImplementJob = explode(',', $staffImplementJob->staff_id);
            foreach ($idStaffImplementJob as $staffId) {
                $listStaffImplementJob[] = Staff::where('id', $staffId)->first();
            }
        }
        return response()->json($listStaffImplementJob);
    }

    public function show($id)
    {
    }

    public function jobCompleteByStaff(Request $request)
    {

        if (isset($request->start_date) && isset($request->end_date)) {
            $start_date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($request->end_date)->endOfDay();
            $jobImplementByStaff = StaffImplementJob::where('staff_id', 'like', '%' . $request->staffId . '%')->get('job_id')->toArray();
            $jobCompleteByStaff = Job::whereIn('id', $jobImplementByStaff)->whereBetween('start_time', [$start_date, $end_date])->get();
        } else {
            $jobImplementByStaff = StaffImplementJob::where('staff_id', 'like', '%' . $request->staffId . '%')->get('job_id')->toArray();
            $jobCompleteByStaff = Job::whereIn('id', $jobImplementByStaff)->get();
        }
        return response()->json($jobCompleteByStaff);
    }
}
