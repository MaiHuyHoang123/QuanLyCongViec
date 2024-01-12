<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Staff;
use GuzzleHttp\Psr7\Response;
use Rap2hpoutre\FastExcel\FastExcel;
use OpenSpout\Common\Entity\Style\Style;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExcelController extends Controller
{
    public static int $i = 0;
    //
    public function index(Request $request)
    {
        $header_style = (new Style())->setFontBold();
        $staff = Staff::where('id',$request->staffId)->first();
        $file = (new FastExcel($request->reportJob))->headerStyle($header_style)->export('báo cáo công việc nhân viên '. $staff->name . '.xlsx',  function($job) {
                ExcelController::$i++;
                return [
                    'STT' => ExcelController::$i,
                    'Tên công việc' => $job['name'],
                    'Ngày bắt đầu' => $job['start_time'],
                    'Ngày hoàn thành' => $job['completed_at'] ?? 'Chưa hoàn thành'
                ];
            });
        ExcelController::$i = 0;
        $explodeArray = explode("\\", $file);
        $filePath = end($explodeArray);
        return response()->json($filePath, 200);
    }

    public function getExcel($file_name)
    {
        return response()->download(public_path($file_name))->deleteFileAfterSend(true);
    }
}
