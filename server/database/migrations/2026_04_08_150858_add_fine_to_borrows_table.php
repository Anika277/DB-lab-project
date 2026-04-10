<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFineToBorrowsTable extends Migration
{
    public function up()
    {
        Schema::table('borrows', function (Blueprint $table) {
            $table->decimal('fine_amount', 10, 2)->default(0);
            $table->boolean('fine_paid')->default(false);
            $table->string('payment_method')->nullable();
            $table->timestamp('paid_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('borrows', function (Blueprint $table) {
            $table->dropColumn(['fine_amount', 'fine_paid', 'payment_method', 'paid_at']);
        });
    }
}