<?php

use App\Models\PayHead;
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
        Schema::create('pay_head_formulas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PayHead::class, 'pay_head_id')->constrained()->onDelete('cascade');
            $table->text('description');
            $table->string('formula');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_head_formulas');
    }
};
