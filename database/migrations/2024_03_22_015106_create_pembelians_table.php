<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id('pembelianID');
            $table->bigInteger('userID')->unsigned(); //foreign key
            $table->foreign('userID')
                  ->references('userID')
                  ->on('user')
                  ->onDelete('cascade');
            $table->string('namaPelanggan');
            $table->decimal('total');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
