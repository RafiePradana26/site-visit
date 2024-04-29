<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteVisitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_site_visit', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('location');
            $table->string('clientName');
            $table->text('purpose');
            $table->string('visit_photo');
            $table->string('sign_photo');
            $table->string('sign_photo_client')->nullable();
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
        Schema::dropIfExists('Site_visit');
    }
}
