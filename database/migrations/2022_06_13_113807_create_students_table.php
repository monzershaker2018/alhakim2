<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->String("name");
            $table->String("address");
            $table->String("father_num");
            $table->String("year");
            $table->String("paid");
            $table->String("not_paid");

            $table->unsignedBigInteger('halaqa_id');
            $table->foreign('halaqa_id')->references('id')->on('halaqas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
