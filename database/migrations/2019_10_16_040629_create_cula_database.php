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
    Schema::create('PROJECTS', function(Blueprint $table) {
		    $table->increments('ID_PROJECT');
		    $table->string('NAME_PROJECT', 255);
		    $table->date('DUE_DATE_PROJECT');

		    $table->timestamps();

		});

		Schema::create('BOARDS', function(Blueprint $table) {
		    $table->increments('ID_BOARD');
		    $table->unsignedInteger('ID_PROJECT');
		    $table->string('NAME_BOARD', 255);
        $table->foreign('ID_PROJECT')->references('ID_PROJECT')->on('PROJECTS');

		    $table->timestamps();

		});

		Schema::create('CARDS', function(Blueprint $table) {
		    $table->increments('ID_CARD');
		    $table->unsignedInteger('ID_BOARD');
		    $table->string('NAME_CARD', 255);

        $table->foreign('ID_BOARD')->references('ID_BOARD')->on('BOARDS');

		    $table->timestamps();

		});

    Schema::create('USER_ROLES', function(Blueprint $table) {
		    $table->increments('ID_ROLE');
		    $table->string('ROLE', 255);


		    $table->timestamps();

		});

    Schema::create('TASKS', function(Blueprint $table) {
		    $table->increments('ID_TASK');
		    $table->unsignedInteger('ID_ROLE');
		    $table->unsignedInteger('ID_CARD');
		    $table->string('NAME_TASK', 255);
		    $table->string('DETAIL_OF_TASK', 255);
		    $table->date('DUE_DATE_TASK');
		    $table->date('START_DATE_TASK');
		    $table->date('FINISH_DATE_TASK');

        $table->foreign('ID_CARD')->references('ID_CARD')->on('CARDS');
        $table->foreign('ID_ROLE')->references('ID_ROLE')->on('USER_ROLES');

		    $table->timestamps();

		});
		Schema::create('CHECK_LISTS', function(Blueprint $table) {
		    $table->increments('ID_CHECK_LIST');
		    $table->unsignedInteger('ID_TASK');
		    $table->string('NAME_CHECKLIST', 255);
		    $table->date('DUE_DATE_CHECKLIST');

        $table->foreign('ID_TASK')->references('ID_TASK')->on('TASKS');

		    $table->timestamps();

		});
    Schema::create('USERS', function(Blueprint $table) {
		    $table->increments('ID_USER');
		    $table->string('NAME_USER', 255);
		    $table->string('EMAIL', 191)->unique();
		    $table->string('USERNAME', 191)->unique();
		    $table->string('PASSWORD', 255);


		    $table->timestamps();

		});
		Schema::create('COMMENTS', function(Blueprint $table) {
		    $table->increments('ID_COMMENT');
		    $table->unsignedInteger('ID_USER');
		    $table->unsignedInteger('ID_TASK');
		    $table->longText('COMMENT');
		    $table->date('DATE');

        $table->foreign('ID_USER')->references('ID_USER')->on('USERS');
        $table->foreign('ID_TASK')->references('ID_TASK')->on('TASKS');

		    $table->timestamps();

		});

		Schema::create('CLUSTERS', function(Blueprint $table) {
		    $table->increments('ID_CLUSTERING');
		    $table->string('NAME_CLUSTERING', 255);


		    $table->timestamps();

		});

		Schema::create('CLUSTERINGS', function(Blueprint $table) {
		    $table->unsignedInteger('ID_CARD');
		    $table->unsignedInteger('ID_CLUSTERING');

        $table->foreign('ID_CARD')->references('ID_CARD')->on('CARDS');
        $table->foreign('ID_CLUSTERING')->references('ID_CLUSTERING')->on('CLUSTERS');
		    $table->primary('ID_CARD', 'ID_CLUSTERING');

		    $table->timestamps();

		});

		Schema::create('LABELS', function(Blueprint $table) {
		    $table->increments('ID_LABEL');
		    $table->unsignedInteger('ID_TASK');
		    $table->string('COLOR_OF_LABEL', 255);
		    $table->string('NAME_LABEL', 255);

        $table->foreign('ID_TASK')->references('ID_TASK')->on('TASKS');

		    $table->timestamps();

		});

		Schema::create('LINKS', function(Blueprint $table) {
		    $table->increments('ID_LINK');
		    $table->unsignedInteger('ID_TASK');
		    $table->string('LINK', 255);

        $table->foreign('ID_TASK')->references('ID_TASK')->on('TASKS');

		    $table->timestamps();

		});

		Schema::create('MEMBER_OF_BOARDS', function(Blueprint $table) {
		    $table->unsignedInteger('ID_BOARD');
		    $table->unsignedInteger('ID_USER');

        $table->foreign('ID_BOARD')->references('ID_BOARD')->on('BOARDS');
        $table->foreign('ID_USER')->references('ID_USER')->on('USERS');
		    $table->primary('ID_BOARD', 'ID_USER');

		    $table->timestamps();

		});

		Schema::create('MEMBER_OF_CARDS', function(Blueprint $table) {
		    $table->unsignedInteger('ID_USER');
		    $table->unsignedInteger('ID_CARD');

        $table->foreign('ID_USER')->references('ID_USER')->on('USERS');
        $table->foreign('ID_CARD')->references('ID_CARD')->on('CARDS');
		    $table->primary('ID_USER', 'ID_CARD');

		    $table->timestamps();

		});

		Schema::create('MEMBER_OF_PROJECTS', function(Blueprint $table) {
		    $table->unsignedInteger('ID_USER');
		    $table->unsignedInteger('ID_PROJECT');

        $table->foreign('ID_USER')->references('ID_USER')->on('USERS');
        $table->foreign('ID_PROJECT')->references('ID_PROJECT')->on('PROJECTS');
		    $table->primary('ID_USER', 'ID_PROJECT');

		    $table->timestamps();

		});

		Schema::create('MEMBER_OF_TASKS', function(Blueprint $table) {
		    $table->unsignedInteger('ID_USER');
		    $table->unsignedInteger('ID_TASK');

        $table->foreign('ID_USER')->references('ID_USER')->on('USERS');
        $table->foreign('ID_TASK')->references('ID_TASK')->on('TASKS');
		    $table->primary('ID_USER', 'ID_TASK');

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
