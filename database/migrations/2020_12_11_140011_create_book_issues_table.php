<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_issues', function (Blueprint $table) {            
            $table->increments('id');
            $table->integer('book_id');
            $table->integer('person_id');
            $table->date('issue_date')->nullable();
            $table->date('return_date')->nullable();
            $table->integer('return_status')->default('1')->comment = '1-Issued, 2-Returned';
            $table->integer('rent')->default('0');
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_issues');
    }
}
