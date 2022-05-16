<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('school_name')->unique();
            $table->string('address');
            $table->string('contact');
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
