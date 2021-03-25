<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorSlotBookedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_slot_bookeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('stripeTransactionId');
            $table->bigInteger('mentorId');
            $table->bigInteger('availableShiftId');
            $table->enum('userType',['mentor','mentee']);
            $table->bigInteger('bookedUserId');
            $table->float('price',8,2);
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentor_slot_bookeds');
    }
}
