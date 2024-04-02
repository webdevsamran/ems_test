<?php

use App\Models\IssueContribution;
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
        Schema::create('issue_contribution_files', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IssueContribution::class,'issue_contribution_id')->constrained();
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_contribution_files');
    }
};
