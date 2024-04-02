<?php

use App\Models\PayHead;
use App\Models\PaySlip;
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
        Schema::create('pay_slip_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'user_id')->constrained();
            $table->foreignIdFor(PaySlip::class,'pay_slip_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PayHead::class,'pay_head_id')->constrained();
            $table->float('amount');
            $table->string('remarks')->nullable();
            $table->string('type');
            $table->date('date');
            $table->boolean('is_deducted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_slip_trackings');
    }
};
