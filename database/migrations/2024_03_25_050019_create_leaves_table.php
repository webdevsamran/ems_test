<?php

use App\Enums\LeaveStatus;
use App\Models\LeaveCategory;
use App\Models\User;
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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'user_id')->constrained();
            $table->foreignIdFor(LeaveCategory::class,'leave_category_id')->constrained();
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason');
            $table->enum('status', LeaveStatus::values())->default(LeaveStatus::PENDING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
