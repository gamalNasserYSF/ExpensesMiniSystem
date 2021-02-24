<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('expenses')) {
            Schema::create('expenses', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('amount');
                $table->string('attachment')->nullable();
                $table->date('entry_date')->nullable();
                $table->integer('status')->default(0);
                $table->integer('user_id');
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
