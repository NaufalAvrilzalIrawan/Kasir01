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
        Schema::create('detail_pembelians', function (Blueprint $table) {
            $table->id('detailID');
            $table->bigInteger('pembelianID')->unsigned(); //foreign key
            $table->foreign('pembelianID')
                  ->references('pembelianID')
                  ->on('pembelian')
                  ->onDelete('cascade');
            $table->bigInteger('produkID')->unsigned(); //foreign key
            $table->foreign('produkID')
                  ->references('produkID')
                  ->on('produk')
                  ->onDelete('cascade');
            $table->string('jumlah');
            $table->decimal('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembelians');
    }
};
