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
        Schema::create('exam_fee_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('servicetype_id')->constrained('service_types')->onDelete('cascade');
            $table->foreignId('center_id')->constrained()->onDelete('cascade');
            $table->string('voucher_no');
            $table->date('exam_date');
            $table->string('student_name');
            $table->string('phone_no');
            $table->integer('total_fee');
            $table->integer('exchange_rate');
            $table->integer('total');
            $table->integer('payment');
            $table->integer('refund');
            $table->string('currency');
            $table->string('payment_type');
            $table->string('bank_name')->nullable();
            $table->text('remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_fee_payments');
    }
};
