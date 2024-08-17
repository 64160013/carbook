<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $departments = [
            ['department_name' => 'ฝ่ายงานวิจัยเทคโนชีวภาพทางทะเล'],
            ['department_name' => 'ฝ่ายงานวิจัยสิ่งแวดล้อมทางทะเล'],
            ['department_name' => 'ฝ่ายงานวิจัยเพาะเลี้ยงสัตว์และพืชทะเล'],
            ['department_name' => 'ฝ่ายงานวิจัยความหลากหลายชีวภาพทางทะเล'],
            
        ];

        foreach ($departments as $department) {
            Department::firstOrCreate(['department_name' => $department['department_name']]);
        }
    }
}
