<?php

// database/migrations/xxxx_xx_xx_create_tasks_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Görev adı
            $table->integer('duration'); // Görev süresi (saat olarak)
            $table->integer('difficulty'); // Görev zorluğu
            $table->string('provider_id'); // Hangi provider'dan geldiği
            $table->timestamps(); // Oluşturulma ve güncellenme zamanları
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
