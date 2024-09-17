<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReqDocument extends Model
{
    protected $table = 'req_document';

    protected $primaryKey = 'document_id';

    protected $fillable = [
        'companion_name',
        'objective',
        'related_project',
        'location',
        'car_pickup',
        'reservation_date',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'sum_companion',
        'car_type',
        'provinces_id',
        'amphoe_id',
        'district_id',
        'work_id',
        'user_id',
        'user_division',
        'user_department'
    ];
    

    public function province()
    {
        return $this->belongsTo(Province::class, 'provinces_id', 'provinces_id');
    }

    public function amphoe()
    {
        return $this->belongsTo(Amphoe::class, 'amphoe_id', 'amphoe_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'district_id');
    }
    
    public function workType()
    {
        return $this->belongsTo(WorkType::class, 'work_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'user_division', 'division_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'user_department', 'department_id');
    }



    public $timestamps = true;  // ใช้ timestamps ที่มีในตาราง
}