<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->string('first_name');
            $table->string('last_name');
            $table->string('birthday');
            $table->enum('gender', ['man', 'women'])->default('man');
            $table->string('phone');
            $table->string('email')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
