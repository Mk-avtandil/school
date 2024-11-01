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
        Schema::create('grades', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->foreignIdFor(Course::class);
            $table->foreignIdFor(Student::class);
            $table->foreignIdFor(Teacher::class);
            $table->integer('grade')->default(0);
            $table->string('comment')->nullable();
        });






    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
};
