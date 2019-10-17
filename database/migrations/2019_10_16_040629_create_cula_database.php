<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCulaDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('BOARD', function(Blueprint $table) {
		    $table->integer('ID_BOARD');
		    $table->integer('ID_PROJECT');
		    $table->string('NAME_BOARD', 255);

		    $table->primary('ID_BOARD');

		    $table->timestamps();

		});

		Schema::create('CARD', function(Blueprint $table) {
		    $table->integer('ID_CARD');
		    $table->integer('ID_BOARD');
		    $table->string('NAME_CARD', 255);

		    $table->primary('ID_CARD');

		    $table->timestamps();

		});

		Schema::create('CHECK_LIST', function(Blueprint $table) {
		    $table->integer('ID_CHECK_LIST');
		    $table->integer('ID_TASK');
		    $table->string('NAME_CHECKLIST', 255);
		    $table->date('DUE_DATE_CHECKLIST');

		    $table->primary('ID_CHECK_LIST');

		    $table->timestamps();

		});

		Schema::create('COMMENT', function(Blueprint $table) {
		    $table->integer('ID_COMMENT');
		    $table->integer('ID_USER');
		    $table->integer('ID_TASK');
		    $table->longText('COMMENT');
		    $table->date('DATE');

		    $table->primary('ID_COMMENT');

		    $table->timestamps();

		});

		Schema::create('CLUSTER', function(Blueprint $table) {
		    $table->integer('ID_CLUSTERING');
		    $table->string('NAME_CLUSTERING', 255);

		    $table->primary('ID_CLUSTERING');

		    $table->timestamps();

		});

		Schema::create('CLUSTERING', function(Blueprint $table) {
		    $table->integer('ID_CARD');
		    $table->integer('ID_CLUSTERING');

		    $table->primary('ID_CARD', 'ID_CLUSTERING');

		    $table->timestamps();

		});

		Schema::create('LABEL', function(Blueprint $table) {
		    $table->integer('ID_LABEL');
		    $table->integer('ID_TASK');
		    $table->string('COLOR_OF_LABEL', 255);
		    $table->string('NAME_LABEL', 255);

		    $table->primary('ID_LABEL');

		    $table->timestamps();

		});

		Schema::create('LINK', function(Blueprint $table) {
		    $table->integer('ID_LINK');
		    $table->integer('ID_TASK');
		    $table->string('LINK', 255);

		    $table->primary('ID_LINK');

		    $table->timestamps();

		});

		Schema::create('MEMBER_OF_BOARD', function(Blueprint $table) {
		    $table->integer('ID_BOARD');
		    $table->integer('ID_USER');

		    $table->primary('ID_BOARD', 'ID_USER');

		    $table->timestamps();

		});

		Schema::create('MEMBER_OF_CARD', function(Blueprint $table) {
		    $table->integer('ID_USER');
		    $table->integer('ID_CARD');

		    $table->primary('ID_USER', 'ID_CARD');

		    $table->timestamps();

		});

		Schema::create('MEMBER_OF_PROJECT', function(Blueprint $table) {
		    $table->integer('ID_USER');
		    $table->integer('ID_PROJECT');

		    $table->primary('ID_USER', 'ID_PROJECT');

		    $table->timestamps();

		});

		Schema::create('MEMBER_OF_TASK', function(Blueprint $table) {
		    $table->integer('ID_USER');
		    $table->integer('ID_TASK');

		    $table->primary('ID_USER', 'ID_TASK');

		    $table->timestamps();

		});

		Schema::create('PROJECT', function(Blueprint $table) {
		    $table->integer('ID_PROJECT');
		    $table->string('NAME_PROJECT', 255);
		    $table->date('DUE_DATE_PROJECT');

		    $table->primary('ID_PROJECT');

		    $table->timestamps();

		});

		Schema::create('TASK', function(Blueprint $table) {
		    $table->integer('ID_TASK');
		    $table->integer('ID_ROLE');
		    $table->integer('ID_CARD');
		    $table->string('NAME_TASK', 255);
		    $table->string('DETAIL_OF_TASK', 255);
		    $table->date('DUE_DATE_TASK');
		    $table->date('START_DATE_TASK');
		    $table->date('FINISH_DATE_TASK');

		    $table->primary('ID_TASK');

		    $table->timestamps();

		});

		Schema::create('USER', function(Blueprint $table) {
		    $table->integer('ID_USER');
		    $table->integer('ID_COMMENT');
		    $table->string('NAME_USERS', 255);
		    $table->string('EMAIL', 255);
		    $table->string('USERNAME', 255);
		    $table->string('PASSWORD', 255);

		    $table->primary('ID_USER');

		    $table->timestamps();

		});

		Schema::create('USER_ROLE', function(Blueprint $table) {
		    $table->integer('ID_ROLE');
		    $table->string('ROLE', 255);

		    $table->primary('ID_ROLE');

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
		Schema::drop('USER_ROLE');
		Schema::drop('USER');
		Schema::drop('TASK');
		Schema::drop('PROJECT');
		Schema::drop('MEMBER_OF_TASK');
		Schema::drop('MEMBER_OF_PROJECT');
		Schema::drop('MEMBER_OF_CARD');
		Schema::drop('MEMBER_OF_BOARD');
		Schema::drop('LINK');
		Schema::drop('LABEL');
		Schema::drop('CLUSTERING');
		Schema::drop('CLUSTER');
		Schema::drop('COMMENT');
		Schema::drop('CHECK_LIST');
		Schema::drop('CARD');
		Schema::drop('BOARD');

    }
}
