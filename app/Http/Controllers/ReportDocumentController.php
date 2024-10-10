<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReqDocument;
use Illuminate\Support\Facades\Auth;

class ReportDocumentController extends Controller
{

    public function index(Request $request)
    {
        $id = $request->input('id'); // รับค่า id จาก request
        
        // ดึงข้อมูลเอกสารพร้อมกับความสัมพันธ์ที่เกี่ยวข้อง
        $documents = ReqDocument::with(['reqDocumentUsers','users', 'province', 'vehicle'])
                                ->findOrFail($id);
        
        return view('driver.reportdocument', compact('documents'));
    }
    
    

    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'stime' => 'required',
    //         'etime' => 'required',
    //         'skilo_num' => 'required|numeric',                     
    //         'ekilo_num' => 'required|numeric',    
    //         'total_companion' => 'required|integer|min:0',
    //         'gasoline_cost' => 'nullable|numeric',
    //         'expressway_toll' => 'nullable|numeric',
    //         'parking_fee' => 'nullable|numeric',
    //         'another_cost' => 'nullable|numeric',
    //         'performance_isgood' => 'required|in:Y,N',
    //         'comment_issue' => 'nullable|string',

    //     ]);

    //     // คำนวณค่าใช้จ่ายรวม
    //     $total_cost = ($request->gasoline_cost ?? 0) + ($request->expressway_toll ?? 0) 
    //                 + ($request->parking_fee ?? 0) + ($request->another_cost ?? 0);

    //     // บันทึกข้อมูลลงในฐานข้อมูล
    //     \App\Models\ReportFormance::create([
    //         'stime' => $request->stime,
    //         'etime' => $request->etime,
    //         'skilo_num' => $request->skilo_num,
    //         'ekilo_num' => $request->ekilo_num,
    //         'total_companion' => $request->total_companion,
    //         'gasoline_cost' => $request->gasoline_cost,
    //         'expressway_toll' => $request->expressway_toll,
    //         'parking_fee' => $request->parking_fee,
    //         'another_cost' => $request->another_cost,
    //         'total_cost' => $total_cost,
    //         'performance_isgood' => $request->performance_isgood, // Save 'Y' or 'N'
    //         'comment_issue' => ($request->performance_isgood === 'N') ? $request->comment_issue : null, // Use $request instead
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);

    //     dd($report); // ดูว่า $report ถูกสร้างขึ้นหรือไม่

    //     \App\Models\ReqDocumentUser::create([
    //         'document_id' => $request->document_id,
    //         'report_id' => $report->id,
    //     ]);
        
    //         return redirect()->route('documents.index')->with('success', 'เพิ่มข้อมูลรายงานสำเร็จ!');

    // }

    public function store(Request $request)
{
    $request->validate([
        'stime' => 'required',
        'etime' => 'required',
        'skilo_num' => 'required|numeric',
        'ekilo_num' => 'required|numeric',
        'total_companion' => 'required|integer|min:0',
        'gasoline_cost' => 'nullable|numeric',
        'expressway_toll' => 'nullable|numeric',
        'parking_fee' => 'nullable|numeric',
        'another_cost' => 'nullable|numeric',
        'performance_isgood' => 'required|in:Y,N',
        'comment_issue' => 'nullable|string',
        
    ]);

    // คำนวณค่าใช้จ่ายรวม
    $total_cost = ($request->gasoline_cost ?? 0) + ($request->expressway_toll ?? 0) 
                + ($request->parking_fee ?? 0) + ($request->another_cost ?? 0);

    // บันทึกข้อมูลลงในฐานข้อมูล
    $report = \App\Models\ReportFormance::create([
        'stime' => $request->stime,
        'etime' => $request->etime,
        'skilo_num' => $request->skilo_num,
        'ekilo_num' => $request->ekilo_num,
        'total_companion' => $request->total_companion,
        'gasoline_cost' => $request->gasoline_cost,
        'expressway_toll' => $request->expressway_toll,
        'parking_fee' => $request->parking_fee,
        'another_cost' => $request->another_cost,
        'total_cost' => $total_cost,
        'performance_isgood' => $request->performance_isgood,
        'comment_issue' => ($request->performance_isgood === 'N') ? $request->comment_issue : null,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // // บันทึกข้อมูลไปยัง req_document_user
    // \App\Models\ReqDocumentUser::create([
    //     // 'document_id' => $request->document_id,
    //     'report_id' => $report->id,
    //     // 'user_id' => Auth::id(), // เพิ่มบรรทัดนี้เพื่อบันทึก user_id ของผู้ใช้ที่ล็อกอิน
    // ]);
    

    return redirect()->route('documents.index')->with('success', 'เพิ่มข้อมูลรายงานสำเร็จ!');
}


}
