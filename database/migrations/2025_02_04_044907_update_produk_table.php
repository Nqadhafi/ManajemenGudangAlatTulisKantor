<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('produk', function (Blueprint $table) {
        // Menghapus kolom harga
        $table->dropColumn('harga');
        
        // Menambahkan kolom satuan
        $table->string('satuan')->nullable();
    });
}

public function down()
{
    Schema::table('produk', function (Blueprint $table) {
        // Menambahkan kolom harga kembali
        $table->integer('harga');
        
        // Menghapus kolom satuan
        $table->dropColumn('satuan');
    });
}
}
