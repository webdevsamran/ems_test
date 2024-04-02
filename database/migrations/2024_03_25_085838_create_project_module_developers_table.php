<?php

use App\Models\ProjectModule;
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
        Schema::create('project_module_developers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ProjectModule::class, 'project_module_id')->constrained()->cascadeOnDelete();
            $table->foreignId( 'developer_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_module_developers');
    }
};
