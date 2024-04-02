<?php

use App\Models\UserDetail;
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
        Schema::create('user_expriances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserDetail::class, 'user_detail_id')->constrained()->onDelete('cascade');
            $table->string('company')->nullable();
            $table->string('designation_start')->nullable();
            $table->string('designation_end')->nullable();
            $table->date('started_date')->nullable();
            $table->date('ended_date')->nullable();
            $table->float('salary_start')->nullable();
            $table->float('salary_end')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_expriances');
    }
};
