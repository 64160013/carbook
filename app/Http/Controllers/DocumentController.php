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
        if (auth()->check()) {
            $user = auth()->user();

            $documents = ReqDocument::whereHas('reqDocumentUsers', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();

            return view('document-history', compact('documents'));
        } else {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        }
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


      
    public function reviewForm(Request $request)
    {
        $id = $request->input('id');
        if (!$id) {
            return redirect()->route('documents.history')->with('error', 'ไม่พบข้อมูลเอกสาร');
        }

        $document = ReqDocument::with(['reqDocumentUsers', 'workType', 'province', 'amphoe', 'district'])->findOrFail($id);

        return view('reviewform', compact('document'));
    }
    
    
    // ฟังก์ชันแสดงหน้าตรวจสอบ (reviewForm)  
    // public function permission()
    // {
    //     if (auth()->check()) {
    //         $user = auth()->user();
    
    //         $isReviewer = in_array($user->role_id, [4, 6, 7, 8, 9, 10, 13, 14, 15, 16]);
    
    //         if ($isReviewer) {
                
    //             $documents = ReqDocument::whereHas('reqDocumentUsers', function ($query) use ($user) {
    //                 $query->where('req_document_user.user_id', '!=', $user->id) // ไม่แสดงฟอร์มที่ผู้ใช้ส่งเอง
    //                     ->where(function ($query) use ($user) {
    //                         // เงื่อนไขการแสดงฟอร์มตาม division_id และ role_id
    //                         if ($user->role_id == 4) {
    //                             $query->where('req_document_user.division_id', 1);
    //                         } elseif ($user->role_id == 6) {
    //                             $query->where('req_document_user.division_id', 3);
    //                         } elseif ($user->role_id == 7) {
    //                             $query->where('req_document_user.division_id', 4);
    //                         } elseif ($user->role_id == 8) {
    //                             $query->where('req_document_user.division_id', 5);
    //                         } elseif ($user->role_id == 9) {
    //                             $query->where('req_document_user.division_id', 6);
    //                         } elseif ($user->role_id == 10) {
    //                             $query->where('req_document_user.division_id', 7);
    //                         } elseif ($user->role_id == 13) {
    //                             $query->where('req_document_user.division_id', 2)
    //                                   ->where('req_document_user.department_id', 1);
    //                         } elseif ($user->role_id == 14) {
    //                             $query->where('req_document_user.division_id', 2)
    //                                   ->where('req_document_user.department_id', 2);
    //                         } elseif ($user->role_id == 15) {
    //                             $query->where('req_document_user.division_id', 2)
    //                                   ->where('req_document_user.department_id', 3);
    //                         } elseif ($user->role_id == 16) {
    //                             $query->where('req_document_user.division_id', 2)
    //                                   ->where('req_document_user.department_id', 4);
    //                         }
    //                     });
    //             })->orderBy('created_at', 'desc')->get();
    //         } else {

    //             $documents = ReqDocument::whereHas('reqDocumentUsers', function ($query) use ($user) {
    //                 $query->where('req_document_user.user_id', $user->id);
    //             })->orderBy('created_at', 'desc')->get();
    //         }
    
    //         return view('permission-form', compact('documents'));
    //     } else {
    //         return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
    //     }
    // }


    //เทียบเท่า Index
    public function permission()
    {
        if (auth()->check()) {

            $user = auth()->user();
            $isReviewer = in_array($user->role_id, [4, 6, 7, 8, 9, 10, 13, 14, 15, 16]);

            $userDocuments = ReqDocument::whereHas('reqDocumentUsers', function ($query) use ($user) {
                $query->where('req_document_user.user_id', $user->id); // เอกสารที่ผู้ใช้ส่งเอง
            });

            if ($isReviewer) {
                // ดึงเอกสารที่ต้องตรวจสอบ
                $reviewDocuments = ReqDocument::whereHas('reqDocumentUsers', function ($query) use ($user) {
                    $query->where('req_document_user.user_id', '!=', $user->id) // ไม่ดึงเอกสารที่ผู้ใช้ส่งเอง
                        ->where(function ($query) use ($user) {
                            // ฟังก์ชันกรองเอกสารตาม division_id และ role_id
                            $this->applyDivisionRoleFilter($query, $user->role_id);
                        });
                });

                // รวมเอกสารที่ผู้ใช้ส่งเองกับเอกสารที่ต้องตรวจสอบ
                $documents = $userDocuments->union($reviewDocuments)->orderBy('created_at', 'desc')->get();
            } else {
                $documents = $userDocuments->orderBy('created_at', 'desc')->get();
            }
            return view('permission-form', compact('documents'));

        } else {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        }
    }



    // ฟังก์ชันช่วยเพื่อแยกเงื่อนไขการกรองตาม role และ division
    private function applyDivisionRoleFilter($query, $roleId)
    {
        if ($roleId == 4) {
            $query->where('req_document_user.division_id', 1);
        } elseif ($roleId == 6) {
            $query->where('req_document_user.division_id', 3);
        } elseif ($roleId == 7) {
            $query->where('req_document_user.division_id', 4);
        } elseif ($roleId == 8) {
            $query->where('req_document_user.division_id', 5);
        } elseif ($roleId == 9) {
            $query->where('req_document_user.division_id', 6);
        } elseif ($roleId == 10) {
            $query->where('req_document_user.division_id', 7);
        } elseif ($roleId == 13) {
            $query->where('req_document_user.division_id', 2)
                ->where('req_document_user.department_id', 1);
        } elseif ($roleId == 14) {
            $query->where('req_document_user.division_id', 2)
                ->where('req_document_user.department_id', 2);
        } elseif ($roleId == 15) {
            $query->where('req_document_user.division_id', 2)
                ->where('req_document_user.department_id', 3);
        } elseif ($roleId == 16) {
            $query->where('req_document_user.division_id', 2)
                ->where('req_document_user.department_id', 4);
        }
    }


    public function permissionAllow(Request $request)
    {
        $id = $request->query('id'); // ดึง id จาก Query Parameter
    
        if (!$id) {
            return redirect()->route('documents.index')->with('error', 'ไม่พบข้อมูลเอกสาร');
        }
    
        $user = auth()->user();
        $document = ReqDocument::with(['reqDocumentUsers', 'workType', 'province', 'amphoe', 'district'])->findOrFail($id);
    
        // ตรวจสอบสิทธิ์การเข้าถึงของผู้ใช้
        $isReviewer = in_array($user->role_id, [4, 6, 7, 8, 9, 10, 13, 14, 15, 16]);
    
        $canAccess = $document->reqDocumentUsers->contains('user_id', $user->id); // ตรวจสอบว่าเป็นผู้ส่งเอกสารหรือไม่
    
        if (!$canAccess && $isReviewer) {
            // ถ้าไม่ใช่ผู้ส่งแต่เป็นผู้ตรวจสอบ ก็ต้องกรองตาม division_id และ role_id
            $query = ReqDocumentUser::where('req_document_id', $id);
            $this->applyDivisionRoleFilter($query, $user->role_id);
            $canAccess = $query->exists();
        }
    
        if (!$canAccess) {
            return redirect()->route('documents.index')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเอกสารนี้');
        }
    
        return view('permission-form-allow', compact('document'));
    }
    
    
    
    public function show(Request $request)
    {
        $id = $request->input('id');
        if (!$id) {
            return redirect()->route('documents.history')->with('error', 'ไม่พบข้อมูลเอกสาร');
        }
        $documents = ReqDocument::with(['reqDocumentUsers', 'workType', 'province', 'amphoe', 'district'])->findOrFail($id);
        return view('permission-form-allow', compact('documents'));

    }
    
       





}