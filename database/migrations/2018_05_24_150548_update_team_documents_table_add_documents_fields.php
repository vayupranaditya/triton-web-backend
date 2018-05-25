<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTeamDocumentsTableAddDocumentsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->unsigned();
            $table->string('active_student_proof');
            $table->string('payment_proof')->nullable();
            $table->string('proposal')->nullable();
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_documents', function (Blueprint $table) {
            $table->dropForeign('team_documents_team_id_foreign');

            $table->dropCollumn('team_id');
            $table->dropCollumn('active_student_proof');
            $table->dropCollumn('payment_proof');
            $table->dropCollumn('proposal');
        });
    }
}
