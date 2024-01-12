<?php

namespace App\Http\Controllers;

use App\Remind;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemindController extends Controller
{
    //
    public function index()
    {
        if(Auth::check()){
            $reminds = Remind::all();
            return view('reminder',compact('reminds'));
        }
        $reminds = Remind::where('staff_id', Auth::guard('staff')->user()->id)->orderBy('remind_date')->get();
        return view('reminder', compact('reminds'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['remind_date'] = Carbon::createFromFormat('d-m-Y', $data['remind_date']);
        $data['staff_id'] = Auth::guard('staff')->user()->id;
        Remind::create($data);
        return redirect(route('reminds.index'))->with('success', 'Thêm nhắc hẹn thành công!');
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $data['remind_date'] = Carbon::createFromFormat('d-m-Y', $data['remind_date']);
        $remind = Remind::where('id',$data['remind_id'])->first();
        if ($remind->staff_id === Auth::guard('staff')->user()->id) {
            $remind->name = $data['name'];
            $remind->description = $data['description'];
            $remind->remind_date = $data['remind_date'];
            $remind->period_remind = $data['period_remind'];
            $remind->save();
            return redirect(route('reminds.index'))->with('success', 'Sửa nhắc hẹn thành công!');
        } else {
            return redirect(route('reminds.index'))->with('error', 'Bạn không có quyền sửa!');
        }
    }

    public function show($id)
    {
        $remind = Remind::where('id', $id)->first();
        return response()->json($remind);
    }
    public function delete($id)
    {
        // Find the record by its primary key
        $remind = Remind::find($id);

        // Check if the record exists
        if ($remind) {
            // If it exists, delete the record
            $remind->delete();

            return redirect(route('reminds.index'))->with('success', 'Xóa thành công');
        } else {
            // If it doesn't exist, handle the case accordingly (e.g., show an error message)
            return redirect(route('reminds.index'))->with('error', 'Không tìm thấy bản ghi');
        }
    }
}
