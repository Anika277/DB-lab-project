<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditLogsTable extends Migration
{
    public function up()
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action');        // 'book_deleted', 'book_edited', 'book_added'
            $table->string('entity_type');   // 'book'
            $table->bigInteger('entity_id'); // book id
            $table->string('entity_name');   // book title
            $table->text('changes')->nullable(); // what changed
            $table->bigInteger('performed_by'); // admin user id
            $table->string('performed_by_name'); // admin name
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
}