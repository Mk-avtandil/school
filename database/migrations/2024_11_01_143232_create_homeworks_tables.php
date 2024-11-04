<?php

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('homeworks', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->foreignIdFor(Course::class)->onDelete('cascade');
            $table->foreignIdFor(Student::class)->onDelete('cascade');
            $table->foreignIdFor(Teacher::class)->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('homeworks');
    }
};
