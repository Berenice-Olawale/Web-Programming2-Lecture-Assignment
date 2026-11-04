<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $db = Schema::connection('react');

        $db->dropIfExists('notebooks');
        $db->dropIfExists('processors');
        $db->dropIfExists('operating_systems');

        $db->create('processors', function (Blueprint $table) {
            $table->id();
            $table->string('manufacturer');
            $table->string('type');
        });

        $db->create('operating_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        $db->create('notebooks', function (Blueprint $table) {
            $table->id();
            $table->string('manufacturer');
            $table->string('type');
            $table->string('display');
            $table->unsignedInteger('memory');
            $table->unsignedInteger('harddisk');
            $table->string('videocontroller');
            $table->unsignedInteger('price');
            $table->unsignedBigInteger('processorid');
            $table->unsignedBigInteger('opsystemid');
            $table->unsignedInteger('pieces')->default(0);
        });
    }

    public function down(): void
    {
        $db = Schema::connection('react');

        $db->dropIfExists('notebooks');
        $db->dropIfExists('processors');
        $db->dropIfExists('operating_systems');
    }
};