<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\address;
class CraeteAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
       $table->increments('id');
        $table->string('fullname');
        $table->string('address');
            $table->date('birth');
        $table->string('passport_n');
        $table->string('identification_n');
            $table->integer('user_id');
        $table->timestamps();
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('address');
    }
}
