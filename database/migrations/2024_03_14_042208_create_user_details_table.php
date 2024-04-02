<?php

use App\Models\CvMedium;
use App\Models\CvSource;
use App\Models\CvType;
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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(CvType::class, 'cv_type_id');
            $table->foreignIdFor(CvSource::class, 'cv_source_id');
            $table->foreignIdFor(CvMedium::class, 'cv_medium_id');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->text('education')->nullable();
            $table->text('experience')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
