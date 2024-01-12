<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\File;
use App\StaffImplementJob;
use App\TeamImplementJob;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Models\Role;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jobs = Job::all();
        return response()->json($jobs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $job = new Job();
        $job->name = $data['name'];
        $job->desc = $data['desc'];
        $job->content = $data['content'];

        $start_time = Carbon::createFromFormat('d-m-Y', $data['start_time']);
        $job->start_time =  $start_time;

        $end_time = Carbon::createFromFormat('d-m-Y', $data['end_time']);
        $job->end_time = $end_time;
        $job->prioritize = $data['prioritize'];
        $job->status = '1';
        $job->save();
        TeamImplementJob::create([
            'team_id' => $request->team_implement_job,
            'job_id' => $job->id
        ]);
        StaffImplementJob::create([
            'staff_id' => $request->staff_implement_job,
            'job_id' => $job->id
        ]);
        // $file = $data['start_file'];
        // $job->start_file =  $file;
        return redirect('/')->with('success', 'Thêm công việc thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $job = Job::find($id);

        $job->status = $data['status'];
        $job->comment = $data['comment'];

        $file = $request->file('complete_file');

        // Tạo đường dẫn lưu trữ dựa trên tháng và năm hiện tại
        $storagePath = 'jobs/' . date('FY');

        // Lưu tệp vào thư mục lưu trữ (storage) với tên gốc
        $filePath = $file->storeAs($storagePath, $file->getClientOriginalName());

        // Lưu thông tin tệp vào cơ sở dữ liệu
        // Job::create([
        //     'download_link' => $filePath,
        //     'original_name' => $file->getClientOriginalName(),
        // ]);[{"download_link":"jobs\\December2023\\vin777.cx-refdomains-subdomains__2023-12-14_14-23-56.csv"}]
        $job->complete_file = $filePath;
        $job->save();
        return redirect('/')->with('success', 'Lưu thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function completeJob(Request $request)
    {
        $job = Job::where('id', $request->jobId)->first();
        $job->completed_at = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        if ($job) {
            if(Auth::check()){
                $job->status = 2;
                $job->save();
                return response()->json(['message' => 'thành công'], 200);
            }elseif(Auth::guard('staff')->check()){
                $role = Role::where('id',Auth::guard('staff')->user()->role_id)->first();
                if($role->name == 'manager'){
                    $job->status = 2;
                    $job->save();
                    return response()->json(['message' => 'thành công'], 200);
                }else{
                    $staffImplementJob = StaffImplementJob::where('job_id',$job->id)->first();
                    if(strpos($staffImplementJob->staff_id, Auth::guard('staff')->user()->id) !== false){
                        $job->status = 2;
                        $job->save();
                        return response()->json(['message' => 'thành công'], 200);
                    }else{
                        return response()->json(['message' => 'bạn không có quyền hoàn thành công việc này'], 400);
                    }
                }
            }else{
                return response()->json(['message' => 'bạn không có quyền hoàn thành công việc này'], 400);
            }
        } else {
            return response()->json(['message' => 'không có công việc trên'], 400);
        }
    }
    public function updateJob(Request $request)
    {
        $job = Job::find($request->job_id);
        if ($job === null) {
            return redirect('/')->with('error', 'không tồn tại bản ghi này');
        } else {
            if(isset($request->team_implement_job)){
                $teamImplementJob = TeamImplementJob::updateOrCreate(
                    ['job_id' => $request->job_id],
                    ['job_id' => $request->job_id, 'team_id' => $request->team_implement_job]
                );
            }
            if(isset($request->staff_implement_job)){
                $staffImplementJob = StaffImplementJob::updateOrCreate(
                    ['job_id' => $request->job_id],
                    ['job_id' => $request->job_id, 'staff_id' => strval($request->staff_implement_job)]
                );
            }
            $start_time = Carbon::createFromFormat('d-m-Y', $request->start_time);
            $end_time = Carbon::createFromFormat('d-m-Y', $request->end_time);
            $dataUpdate = collect($request->all())->forget('team_implement_job')
            ->forget('_token')->forget('start_time')->forget('end_time')
            ->merge(['start_time' => $start_time,'end_time' => $end_time])->toArray();
            $job->update($dataUpdate);
            return redirect('/')->with('success', 'sửa thành công');
        }
    }
}
