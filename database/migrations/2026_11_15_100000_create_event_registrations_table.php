<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('event_name', 200);
            $table->date('registration_date');
            $table->string('participant_name');
            $table->string('participant_student_id', 50)->nullable();
            $table->string('participant_email')->nullable();
            $table->string('participant_phone', 30)->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->text('decision_note')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['event_name', 'registration_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};