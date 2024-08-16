<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartmentAndDivisionToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // ตรวจสอบว่าคอลัมน์มีอยู่แล้วหรือไม่
            if (!Schema::hasColumn('users', 'department_id')) {
                $table->unsignedBigInteger('department_id')->nullable();
            }

            if (!Schema::hasColumn('users', 'division_id')) {
                $table->unsignedBigInteger('division_id')->nullable();
            }

            // สร้างข้อกำหนดforeign
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['division_id']);
            $table->dropColumn(['department_id', 'division_id']);
        });
    }
}
