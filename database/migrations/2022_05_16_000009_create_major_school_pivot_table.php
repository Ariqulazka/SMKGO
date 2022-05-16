<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMajorSchoolPivotTable extends Migration
{
    public function up()
    {
        Schema::create('major_school', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id', 'school_id_fk_6598216')->references('id')->on('schools')->onDelete('cascade');
            $table->unsignedBigInteger('major_id');
            $table->foreign('major_id', 'major_id_fk_6598216')->references('id')->on('majors')->onDelete('cascade');
        });
    }
}
