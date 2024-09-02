<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Amphoe;
use App\Models\District;

class ReqDocumentController extends Controller
{
    public function create() {
        $provinces = Province::all();
        $amphoes = Amphoe::all();
        $districts = District::all();

        return view('req_documents.create', compact('provinces', 'amphoes', 'districts'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'provinces_id' => 'required|exists:provinces,id',
            'amphoe_id' => 'required|exists:amphoes,id',
            'district_id' => 'required|exists:districts,id',
        ]);

        return redirect()->route('req_documents.create')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function getAmphoes($provinceId)
    {
        $amphoes = Amphoe::where('provinces_id', $provinceId)->get(['amphoe_id as id', 'name_th as name']);
        return response()->json($amphoes);
    }
    

    public function getDistricts($amphoeId)
    {
        $districts = District::where('amphoe_id', $amphoeId)->get(['district_id as id', 'name_th as name']);
        return response()->json($districts);
    }


    // public function getDistricts($amphoeId)
    // {
    //     try {
    //         $districts = District::where('amphoe_id', $amphoeId)->get(['district_id as id', 'name_th as name']);
    //         return response()->json($districts);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }
    
    
    
}

