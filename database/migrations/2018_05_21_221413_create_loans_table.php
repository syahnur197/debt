<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('debtor_name');
            $table->string('debtor_ic')->nullable();
            $table->string('debtor_phone');
            $table->text('debtor_address')->nullable();
            $table->string('photo')->default("uploads/user.png");
            $table->text('note')->nullable();
            $table->decimal('amount', 10, 2);
            $table->date('payback_date')->nullable();
            $table->date('loan_date')->nullable();
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
        Schema::dropIfExists('loans');
    }
}
