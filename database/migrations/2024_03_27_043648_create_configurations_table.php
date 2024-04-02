<?php

use App\Models\ConfigurationCategory;
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
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('label')->nullable();
            $table->string('plural_label')->nullable();
            $table->string('navigation_icon')->nullable();
            $table->foreignIdFor(ConfigurationCategory::class,'configuration_category_id')->nullable();
            $table->string('navigation_sort')->nullable();
            $table->string('navigation_badge_tooltip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
