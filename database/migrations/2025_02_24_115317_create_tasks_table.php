<?php

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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('task_category_id')->nullable();
            $table->text('name')->nullable();
            $table->string('assign_date')->nullable();
            $table->string('assign_by')->nullable();
            $table->string('deadline')->nullable();
            $table->string('priority')->nullable();
            $table->text('remark')->nullable();
            $table->text('admin_comment')->nullable();
            $table->string('status')->default('Pending');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_category_id')->references('id')->on('task_categories')->onDelete('cascade');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
