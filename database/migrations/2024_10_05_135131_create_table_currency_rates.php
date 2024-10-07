<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id');
            $table->date('date');
            $table->string('abbreviation');
            $table->integer('scale');
            $table->string('name');
            $table->decimal('rate', 10, 4);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currency_rates');
    }
};
