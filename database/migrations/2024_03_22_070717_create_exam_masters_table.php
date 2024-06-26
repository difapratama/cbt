<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_masters', function (Blueprint $table) {
            $table->id();
            $table->string('exam_id');
            $table->foreignId('category_id');
            $table->string('abbreviation');
            $table->string('name');
            $table->date('exam_date');
            $table->string('exam_duration');
            $table->string('is_active')->nullable()->default(1);
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
        Schema::dropIfExists('exam_masters');
    }
};
