<?php

use App\Enums\IssuePriority;
use App\Enums\IssueStatus;
use App\Models\IssueCategory;
use App\Models\Project;
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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IssueCategory::class, 'issue_category_id')->constrained();
            $table->foreignIdFor(Project::class, 'project_id')->constrained();
            $table->foreignIdFor(User::class, 'user_id')->constrained();
            $table->string('title');
            $table->string('deadline');
            $table->text('description');
            $table->enum('status', IssueStatus::values())->default(IssueStatus::Pending);
            $table->enum('type', IssuePriority::values())->default(IssuePriority::Low);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
