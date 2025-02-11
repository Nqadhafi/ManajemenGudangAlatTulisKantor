<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTransaksiKeterangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('transaksi', function (Blueprint $table) {

        // Menambahkan kolom satuan
        $table->text('keterangan')->nullable();
    });
}

public function down()
{
    Schema::table('transaksi', function (Blueprint $table) {
    
        // Menghapus kolom satuan
        $table->text('keterangan');
    });
}
}
