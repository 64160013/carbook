<?php

namespace App\Http\Controllers;

use App\Models\ReqDocument;
use App\Models\ReqDocumentUser;
use App\Models\User;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // ดึงข้อมูลผู้ใช้ปัจจุบัน

        $documents = ReqDocument::whereHas('reqDocumentUsers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('document-history', compact('documents'));
    }
    
    

    // public function store(Request $request)
    // {
    //     // Validate and save the document data
    //     $document = new Document();
    //     $document->fill($request->all());
    //     $document->user_id = auth()->id(); // บันทึก user_id ของผู้ส่ง
    //     $document->save();

    //     // ตรวจสอบ division_id ของผู้ใช้ที่ส่งฟอร์ม
    //     $user = auth()->user();
    //     $reviewers = [];

    //     // กำหนดเงื่อนไขการส่งฟอร์มไปหาผู้ใช้ที่มี role_id ที่กำหนด
    //     if ($user->division_id == 1) {
    //         $reviewers = User::where('role_id', 4)->pluck('id')->toArray();
    //     } elseif ($user->division_id == 3) {
    //         $reviewers = User::where('role_id', 6)->pluck('id')->toArray();
    //     } elseif ($user->division_id == 4) {
    //         $reviewers = User::where('role_id', 7)->pluck('id')->toArray();
    //     } elseif ($user->division_id == 5) {
    //         $reviewers = User::where('role_id', 8)->pluck('id')->toArray();
    //     } elseif ($user->division_id == 6) {
    //         $reviewers = User::where('role_id', 9)->pluck('id')->toArray();
    //     } elseif ($user->division_id == 7) {
    //         $reviewers = User::where('role_id', 10)->pluck('id')->toArray();
    //     } elseif ($user->division_id == 2) {

    //         // ตรวจสอบค่า department_id
    //         if ($user->department_id == 1) {
    //             $reviewers = User::where('role_id', 13)->pluck('id')->toArray();
    //         } elseif ($user->department_id == 2) {
    //             $reviewers = User::where('role_id', 14)->pluck('id')->toArray();
    //         } elseif ($user->department_id == 3) {
    //             $reviewers = User::where('role_id', 15)->pluck('id')->toArray();
    //         } elseif ($user->department_id == 4) {
    //             $reviewers = User::where('role_id', 16)->pluck('id')->toArray();
    //         }
    //     }

    //     // เชื่อมโยงผู้ตรวจสอบกับเอกสาร โดยบันทึกลงใน req_document_user
    //     foreach ($reviewers as $reviewer) {
    //         \DB::table('req_document_user')->insert([
    //             'req_document_id' => $document->id,
    //             'user_id' => $reviewer,
    //         ]);
    //     }

    //     return redirect()->route('documents.index')->with('success', 'ฟอร์มถูกส่งแล้ว');
    // }


    // ฟังก์ชันแสดงหน้าตรวจสอบ (reviewForm)
    // public function reviewForm()
    // {
    //     $user = auth()->user();
        
        
    //     // ตรวจสอบว่าเป็นผู้ตรวจสอบหรือไม่ โดยดูจาก role_id
    //     $isReviewer = in_array($user->role_id, [4, 6, 7, 8, 9, 10, 13, 14, 15, 16]);

    //     if ($isReviewer) {
    //         // ผู้ใช้เป็นผู้ตรวจสอบ แสดงเฉพาะฟอร์มที่ต้องตรวจสอบตาม division_id
    //         $documents = ReqDocument::whereHas('reqDocumentUsers', function ($query) use ($user) {
    //             $query->where('req_document_user.user_id', '!=', $user->id) // ไม่แสดงฟอร์มที่ผู้ใช้ส่งเอง
    //                 ->where(function ($query) use ($user) {
    //                     // เงื่อนไขการแสดงฟอร์มตาม division_id และ role_id
    //                     if ($user->role_id == 4) {
    //                         $query->where('req_document_user.division_id', 1);
    //                     } elseif ($user->role_id == 6) {
    //                         $query->where('req_document_user.division_id', 3);
    //                     } elseif ($user->role_id == 7) {
    //                         $query->where('req_document_user.division_id', 4);
    //                     } elseif ($user->role_id == 8) {
    //                         $query->where('req_document_user.division_id', 5);
    //                     } elseif ($user->role_id == 9) {
    //                         $query->where('req_document_user.division_id', 6);
    //                     } elseif ($user->role_id == 10) {
    //                         $query->where('req_document_user.division_id', 7);

    //                     } elseif ($user->role_id == 13) {
    //                         $query->where('req_document_user.division_id', 2)
    //                             ->where('req_document_user.department_id', 1);
    //                     } elseif ($user->role_id == 14) {
    //                         $query->where('req_document_user.division_id', 2)
    //                             ->where('req_document_user.department_id', 2);
    //                     } elseif ($user->role_id == 15) {
    //                         $query->where('req_document_user.division_id', 2)
    //                             ->where('req_document_user.department_id', 3);
    //                     } elseif ($user->role_id == 16) {
    //                         $query->where('req_document_user.division_id', 2)
    //                             ->where('req_document_user.department_id', 4);
    //                     }
    //                 });
    //         })->orderBy('created_at', 'desc')->get();
    //     } else {
    //         // ผู้ใช้เป็นผู้ส่งฟอร์มเอง แสดงเฉพาะฟอร์มของตัวเอง
    //         $documents = ReqDocument::whereHas('reqDocumentUsers', function ($query) use ($user) {
    //             $query->where('req_document_user.user_id', $user->id); // ดึงฟอร์มที่ผู้ใช้เป็นคนส่ง
    //         })->orderBy('created_at', 'desc')->get();
    //     }

    //     return view('reviewform', compact('documents'));
    // }
    
    public function reviewForm(Request $request)
{
    $id = $request->input('id');
    if (!$id) {
        return redirect()->route('documents.history')->with('error', 'ไม่พบข้อมูลเอกสาร');
    }

    $user = auth()->user();
    $isReviewer = in_array($user->role_id, [4, 6, 7, 8, 9, 10, 13, 14, 15, 16]);

    if ($isReviewer) {
        // ผู้ใช้เป็นผู้ตรวจสอบ แสดงเฉพาะฟอร์มที่ต้องตรวจสอบตาม division_id
        $document = ReqDocument::where('document_id', $id)
            ->whereHas('reqDocumentUsers', function ($query) use ($user) {
                $query->where('req_document_user.user_id', '!=', $user->id) // ไม่แสดงฟอร์มที่ผู้ใช้ส่งเอง
                    ->where(function ($query) use ($user) {
                        if ($user->role_id == 4) {
                            $query->where('req_document_user.division_id', 1);
                        } elseif ($user->role_id == 6) {
                            $query->where('req_document_user.division_id', 3);
                        } elseif ($user->role_id == 7) {
                            $query->where('req_document_user.division_id', 4);
                        } elseif ($user->role_id == 8) {
                            $query->where('req_document_user.division_id', 5);
                        } elseif ($user->role_id == 9) {
                            $query->where('req_document_user.division_id', 6);
                        } elseif ($user->role_id == 10) {
                            $query->where('req_document_user.division_id', 7);
                        } elseif ($user->role_id == 13) {
                            $query->where('req_document_user.division_id', 2)
                                ->where('req_document_user.department_id', 1);
                        } elseif ($user->role_id == 14) {
                            $query->where('req_document_user.division_id', 2)
                                ->where('req_document_user.department_id', 2);
                        } elseif ($user->role_id == 15) {
                            $query->where('req_document_user.division_id', 2)
                                ->where('req_document_user.department_id', 3);
                        } elseif ($user->role_id == 16) {
                            $query->where('req_document_user.division_id', 2)
                                ->where('req_document_user.department_id', 4);
                        }
                    });
            })
            ->with(['reqDocumentUsers', 'workType', 'province', 'amphoe', 'district'])
            ->firstOrFail();
    } else {
        // ผู้ใช้ไม่ใช่ผู้ตรวจสอบ แสดงเฉพาะฟอร์มของตัวเอง
        $document = ReqDocument::where('document_id', $id)
            ->whereHas('reqDocumentUsers', function ($query) use ($user) {
                $query->where('req_document_user.user_id', $user->id); // ดึงฟอร์มที่ผู้ใช้เป็นคนส่ง
            })
            ->with(['reqDocumentUsers', 'workType', 'province', 'amphoe', 'district'])
            ->firstOrFail();
    }

    return view('reviewform', compact('document')); // ส่งตัวแปรเป็น single document
}







}