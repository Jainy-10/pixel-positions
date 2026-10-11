<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\User::class)
                ->constrained()
                ->cascadeOnDelete();
            
            $table->foreignIdFor(App\Models\Job::class)
                ->constrained()
                ->cascadeOnDelete();
            
            $table->string('resume')->nullable();
            $table->string('resume_original_name')->nullable();
            $table->text('cover_letter')->nullable();
            

            $table->enum('status', [
                'pending',
                'reviewing',
                'shortlisted',
                'interview',
                'accepted',
                'rejected',
                'withdrawn'
            ])->default('pending');

            $table->dateTime('interview_at')->nullable();
            $table->text('instructions')->nullable()->after('interview_at');    

            $table->timestamps();
            $table->unique(['user_id', 'job_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
