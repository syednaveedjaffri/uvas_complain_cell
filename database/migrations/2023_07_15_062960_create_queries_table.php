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
        Schema::create('queries', function (Blueprint $table) {
            $table->id();
//            $table->string('complainer_name');
            $table->foreignId('userprofile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('campus_id')->constrained()->cascadeOnDelete();
            $table->foreignId('faculty_id')->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->foreignId('complaincategory_id')->constrained()->cascadeOnDelete();
            $table->foreignId('complaincategorytype_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('complain_id')->constrained()->cascadeOnDelete();
            $table->string('complain_statement')->nullable();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // $table->boolean('status')->default('0');
            $table->string('status')->default('inprocess');
            // $table->string('vendor_status')->default('pending');
            // $table->date('send_to_vendor')->nullable();
            $table->date('send_to_dept')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('queries');
    }
};
