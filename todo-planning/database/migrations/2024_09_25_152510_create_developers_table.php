<?php

// database/migrations/xxxx_xx_xx_create_developers_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopersTable extends Migration
{
    public function up()
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Görev adı
            $table->integer('duration'); // Görev süresi (saat olarak)
            $table->integer('difficulty'); // Görev zorluğu
            $table->string('developer_id'); // Hangi provider'dan geldiği
            $table->timestamps(); // Oluşturulma ve güncellenme zamanları
        });
    }

    public function down()
    {
        Schema::dropIfExists('developers');
    }
}

