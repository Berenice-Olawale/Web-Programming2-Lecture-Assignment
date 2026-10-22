
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notebooks', function (Blueprint $table) {
            $table->id();
            $table->string('manufacturer');
            $table->string('type');
            $table->string('display');
            $table->string('memory');
            $table->string('harddisk');
            $table->string('videocontroller');
            $table->decimal('price', 10, 2);

            $table->foreignId('processorid')
                ->constrained('processors')
                ->restrictOnDelete();

            $table->foreignId('opsystemid')
                ->constrained('operating_systems')
                ->restrictOnDelete();

            $table->unsignedInteger('pieces')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notebooks');
    }
};
