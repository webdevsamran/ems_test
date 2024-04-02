<?php

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
        Schema::create('salary_setups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained();
            $table->string('bank_name');
            $table->string('account_name');
            $table->string('account_number');
            $table->string('account_ifcs_code');
//            $table->float('yearly_salary');
//            $table->float('monthly_salary');
//            $table->float('yearly_deduction');
//            $table->float('monthly_deduction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_setups');
    }
};
