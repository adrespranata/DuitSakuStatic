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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('category_id');
            $table->foreignId('category_id')->constrained('expense_categories')->onDelete('cascade');
            $table->date('date');
            $table->decimal('amount', 10, 2);
            $table->text('description')->nullable();
            $table->timestamps();

            // Definisikan kunci asing untuk user_id
            // $table->foreign('category_id')->references('id')->on('expense_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
