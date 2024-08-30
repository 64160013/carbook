<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\CarIcon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome');
    }


    /**
     * Add Vehicle Form
     *
     * 
     */
    public function AddVehicleForm()
    {
        $selectedIcons = Vehicle::pluck('icon_id')->toArray();                  // ดึงรายการไอคอนพาหนะที่ถูกเลือกไปแล้ว
        $car_icons = CarIcon::whereNotIn('icon_id', $selectedIcons)->get();     // กรองที่ยังไม่ได้ถูกเลือก
        // $car_icons = \App\Models\CarIcon::all();
        return view('addVehicle', compact('car_icons'));
    }
    
    public function storeVehicle(Request $request)
    {
        // Validate the input
        $request->validate([
            'icon_id' => ['required', 'exists:car_icon,icon_id'],
            'car_category' => 'required|string|max:3',                  //varchar(3)
            'car_regnumber' => 'required|integer|digits_between:1,4',   //int(4)
            'car_province' => 'required|string|max:255',       
            // 'car_regnumber' => 'required|string|max:255',                //รวม            
            // 'car_regnumber' => 'required|integer|digits_between:1,4',  

        ]);

        // Store the data into the database (Assuming a Vehicle model exists)
        \App\Models\Vehicle::create([
            'icon_id' => $request->icon_id, 
            'car_category' => $request->car_category,
            'car_regnumber' => $request->car_regnumber,
            'car_province' => $request->car_province,

        ]);
        
        return redirect()->route('add.vehicle')->with('success', 'เพิ่มข้อมูลรถ สำเร็จ!!!');
    }


        /**
     * "Show" "Change Status" "Delete" Vehicle 
     *
     * 
     */
    public function showVehicles()
    {
        $vehicles = Vehicle::all();
        $car_icons = CarIcon::all();

        return view('vehicles.index', compact('vehicles', 'car_icons'));
    }

    public function updateStatus(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);

        if ($vehicle) {
            $vehicle->car_status = $request->input("car_status_$id");   // รับค่าจากฟอร์ม
            // ตรวจสอบว่าหากสถานะเป็น "ไม่พร้อม" ให้บันทึก car_reason
            if ($vehicle->car_status == 'N') {
                $vehicle->car_reason = $request->input("car_reason_$id");
            } else {
                $vehicle->car_reason = null;// ล้างค่า car_reason ถ้ารถพร้อมใช้งาน
            }
            $vehicle->save();
            
            return redirect()->route('show.vehicles')->with('success', 'อัปเดตสถานะเรียบร้อยแล้ว');
        }

        // แจ้งเตือนหากไม่พบข้อมูล
        return redirect()->route('show.vehicles')->with('error', 'ไม่พบข้อมูลรถ');
    }

    public function destroy($id)
    {
        // ค้นหาข้อมูลรถตาม car_id และทำการลบ
        $vehicle = Vehicle::find($id);
        if ($vehicle) {
            $vehicle->delete();
        }
        return redirect()->route('show.vehicles');
    }

    

}
