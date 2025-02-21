<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStokMinimumToProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->integer('stok_minimum')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('stok_minimum');
        });
    }
    
}
