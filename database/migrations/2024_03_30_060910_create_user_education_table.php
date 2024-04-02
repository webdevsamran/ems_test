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
        Schema::create('user_education', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserDetail::class, 'user_detail_id')->constrained()->onDelete('cascade');
            $table->string('degree')->nullable();
            $table->string('institution')->nullable();
            $table->string('city')->nullable();
            $table->date('passing_year')->nullable();
            $table->string('cgpa')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_education');
    }
};
