<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('msg_id')->unique();
            $table->string('webhook');
            $table->string('subject');
            $table->string('body');
            $table->bigInteger('recipient_id')->unsigned();
            $table->bigInteger('sender_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('provider_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();
            $table->timestamp('timestamp');
            $table->timestamps();

            $table->foreign('recipient_id')->references('id')->on('recipients');
            $table->foreign('sender_id')->references('id')->on('senders');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
