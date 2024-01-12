<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Staff;
use App\StaffImplementJob;
use App\Team;
use App\TeamImplementJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use TCG\Voyager\Models\Role;

class IndexController extends Controller
{
    public static function getIndexCompleteJob($jobs){
        for($i = $jobs->count() - 1; $i >= 0; $i--){
            if($jobs[$i]->status != 2){
                return $i;
            }
        }
    }
    public function home(Request $request){
        $job = new Job();
        $jobs = Job::orderBy('prioritize', 'desc')
            ->orderBy('end_time'); 
        if(Auth::guard('staff')->check()){
            $role = Role::where('id',Auth::guard('staff')->user()->role_id)->first();
            if($role->name != "manager"){
                $idJobImplementByStaff = StaffImplementJob::where('staff_id','like','%' . Auth::guard('staff')->user()->id . '%')->select('job_id')->get();
                $jobs = $jobs->whereIn('id',$idJobImplementByStaff);
            }
        }
        if(isset($request->status)){
            if($request->status != 0){
                $jobs = $jobs->where('status',$request->status);
            }
        }
        $jobs = $jobs->get();
        // dd($jobs);
        for ($i = 0; $i < $jobs->count(); $i++) {
            $indexCompleteJob = IndexController::getIndexCompleteJob($jobs);
            if($indexCompleteJob < $i || !isset($indexCompleteJob)) break;
            if($jobs[$i]->status == 2){
                $job = $jobs[$i];
                $jobs[$i] = $jobs[$indexCompleteJob];
                $jobs[$indexCompleteJob] = $job;
            } 
        }
        return view('home', compact('jobs'));
    }
    public function getJobDetail($id){
        $job = Job::find($id);
        if (isset($job->start_file)) {
            $fileInfoStart = json_decode($job->start_file, true);
            $job->file_name = $fileInfoStart[0]['original_name'] ? $fileInfoStart[0]['original_name'] : 'None';
            $job->file_link = $fileInfoStart[0]['download_link'] ? $fileInfoStart[0]['download_link'] : '#';
        }  
        else {
            $job->file_name = 'No File';
            $job->file_link = '#';
        }
        if (isset($job->complete_file)) {
            $fileInfoComp = json_decode($job->complete_file, true);
            $job->file_name_comp = isset($fileInfoComp[0]['original_name']) ? $fileInfoComp[0]['original_name'] : 'None';
            $job->file_link_comp = isset($fileInfoComp[0]['download_link']) ? $fileInfoComp[0]['download_link'] : '#';
        }  
        else {
            $job->file_name_comp = 'No File';
            $job->file_link_comp = '#';
        }
        return view('modal.job_modal', compact('job'));
    }
    public function jobEdit($id){
        $job = Job::find($id);
        if (isset($job->start_file)) {
            $fileInfoStart = json_decode($job->start_file, true);
            $job->file_name = $fileInfoStart[0]['original_name'] ? $fileInfoStart[0]['original_name'] : 'None';
            $job->file_link = $fileInfoStart[0]['download_link'] ? $fileInfoStart[0]['download_link'] : '#';
        }  
        else {
            $job->file_name = 'No File';
            $job->file_link = '#';
            
        }
        $teamImplementJob = TeamImplementJob::where('job_id',$job->id)->first();
        if($teamImplementJob === null) {
            return view('modal.edit_modal', compact('job'));
        }else{
            $team = Team::where('id',$teamImplementJob->id)->first();
            return view('modal.edit_modal', compact('job','team'));
        }
    }
    public function getReport($id){
        $job = Job::find($id);
        return view('modal.report_modal', compact('job'));
    }
    public function staff(){
        $staffs = Staff::orderBy('id', 'DESC')->paginate(10);
        return view('staff', compact('staffs'));
    }
    public function team(){
        $teams = Team::orderBy('id', 'DESC')->paginate(10);
        return view('team', compact('teams'));
    }
    public function filter($value){
        if ($value == 6 || $value == 0) {
            return Redirect::to('/');
        } else {
            if(Auth::check()){
                $jobs = Job::where('status', $value)->paginate(10);
            }elseif(Auth::guard('staff')->check()){
                $role = Role::where('id',Auth::guard('staff')->user()->role_id);
                if($role === 'manager'){
                    $jobs = Job::where('status', $value)->paginate(10);
                }else{
                    $jobImplementByStaff = StaffImplementJob::where('staff_id','like','%' . Auth::guard('staff')->user()->id . '%')->get('job_id');
                    $arrayJob = $jobImplementByStaff->toArray();
                    $jobs = Job::whereIn('id',$arrayJob)->where('status', $value)->paginate(10);
                }
            }
        }
        return view('home', compact('jobs'));
    }

    public function filterJobByTeam(Request $request){
        $job = new Job();
        $jobs = Job::orderBy('prioritize', 'desc')
            ->orderBy('end_time');
        if(isset($request->status)){
            if($request->status != 0){
                $jobs = $jobs->where('status',$request->status);
            }
        }
        if(isset($request->team)){
            if($request->team != 0){
                $idJobImplementByTeam = TeamImplementJob::where('team_id',$request->team)->get('job_id')->toArray();
                $jobs = $jobs->whereIn('id',$idJobImplementByTeam);
            }
        }
        $jobs = $jobs->get();
        for ($i = 0; $i < $jobs->count(); $i++) {
            $indexCompleteJob = IndexController::getIndexCompleteJob($jobs);
            if($indexCompleteJob < $i || !isset($indexCompleteJob)) break;
            if($jobs[$i]->status == 2){
                $job = $jobs[$i];
                $jobs[$i] = $jobs[$indexCompleteJob];
                $jobs[$indexCompleteJob] = $job;
            } 
        }
        return view('manager_home', compact('jobs'));
    }
}
