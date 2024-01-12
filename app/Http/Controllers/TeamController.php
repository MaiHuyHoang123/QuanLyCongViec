<?php

namespace App\Http\Controllers;

use App\Team;
use App\TeamImplementJob;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // lấy tất cả các team hiện có
    public function getAllTeam(){
        $teams = Team::all();
        return response()->json($teams);
    }
    // lấy team thực hiện job có id
    public function getTeamImplementJob(string $id) {
        $teamImplementJob = TeamImplementJob::where('job_id',$id)->first();
        if($teamImplementJob)
            $team = Team::where('id',$teamImplementJob->team_id)->first();
        else
            $team = null;
        return response()->json($team);
    }
}
