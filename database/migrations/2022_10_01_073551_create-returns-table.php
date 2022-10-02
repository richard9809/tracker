<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returns', function(Blueprint $table){
            $table->id();
            $table->date('returnDate');
            $table->integer('AmountReturned');
            $table->unsignedBigInteger('issue_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('teller_id');
            $table->timestamps();
            $table->foreign('customer_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('teller_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('issue_id')
                    ->references('id')
                    ->on('issues')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returns');
    }
}
