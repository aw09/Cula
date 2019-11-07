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
		    $table->increments('id');
		    $table->string('name', 255);
		    $table->date('due_date')->nullable();

		    $table->timestamps();

		});

		Schema::create('BOARDS', function(Blueprint $table) {
		    $table->increments('id');
		    $table->unsignedInteger('id_project');
		    $table->string('name', 255);
        $table->foreign('id_project')->references('id')->on('PROJECTS');

		    $table->timestamps();

		});

		Schema::create('CARDS', function(Blueprint $table) {
		    $table->increments('id');
		    $table->unsignedInteger('id_board');
		    $table->string('name', 255);

        $table->foreign('id_board')->references('id')->on('BOARDS');

		    $table->timestamps();

		});

    Schema::create('USER_ROLES', function(Blueprint $table) {
		    $table->increments('id');
		    $table->string('role', 255);


		    $table->timestamps();

		});

		Schema::create('LABELS', function(Blueprint $table) {
		    $table->increments('id');
		    $table->string('color_of_label', 255);
		    $table->string('label', 255);

		    $table->timestamps();

		});

		Schema::create('TASKS', function(Blueprint $table) {
		    $table->increments('id');
		    $table->unsignedInteger('id_role');
			$table->unsignedInteger('id_card');
			$table->unsignedInteger('id_label');
		    $table->string('task', 255);
		    $table->string('detail_of_task', 255);
		    $table->date('due_date')->nullable();
		    $table->date('start_date')->nullable();
		    $table->date('finish_date')->nullable();

        $table->foreign('id_card')->references('id')->on('CARDS');
		$table->foreign('id_role')->references('id')->on('USER_ROLES');
		$table->foreign('id_label')->references('id')->on('LABELS');

		    $table->timestamps();

		});

		Schema::create('CHECK_LISTS', function(Blueprint $table) {
		    $table->increments('id');
		    $table->unsignedInteger('id_task');
		    $table->string('check_list', 255);
		    $table->date('due_date');

        $table->foreign('id_task')->references('id')->on('TASKS');

		    $table->timestamps();

		});
    Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->nullable();
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });

    // Schema::create('USERS', function(Blueprint $table) {
		//     $table->increments('id');
		//     $table->string('name', 255);
		//     $table->string('email', 255);
		//     $table->string('username', 255);
		//     $table->string('password', 255);
    //
    //
		//     $table->timestamps();
    //
		// });

		Schema::create('COMMENTS', function(Blueprint $table) {
		    $table->increments('id');
		    $table->unsignedInteger('id_user');
		    $table->unsignedInteger('id_task');
		    $table->longText('comment');
		    $table->date('date');

        $table->foreign('id_user')->references('id')->on('USERS');
        $table->foreign('id_task')->references('id')->on('TASKS');

		    $table->timestamps();

		});

		Schema::create('CLUSTERS', function(Blueprint $table) {
		    $table->increments('id');
		    $table->string('cluster', 255);


		    $table->timestamps();

		});

		Schema::create('CLUSTERINGS', function(Blueprint $table) {
		    $table->unsignedInteger('id_card');
		    $table->unsignedInteger('id_cluster');

        $table->foreign('id_card')->references('id')->on('CARDS');
        $table->foreign('id_cluster')->references('id')->on('CLUSTERS');
		    $table->primary('id_card', 'id_cluster');

		    $table->timestamps();

		});


		Schema::create('LINKS', function(Blueprint $table) {
		    $table->increments('id');
		    $table->unsignedInteger('id_task');
		    $table->string('link', 255);

        $table->foreign('id_task')->references('id')->on('TASKS');

		    $table->timestamps();

		});


		Schema::create('NOTIFICATIONS', function(Blueprint $table) {
		    $table->increments('id');
		    $table->string('notification', 255);
			$table->date('date');
			$table->unsignedInteger('id_user');

        $table->foreign('id_user')->references('id')->on('users');

		    $table->timestamps();

		});

		Schema::create('MEMBER_OF_BOARDS', function(Blueprint $table) {
		    $table->unsignedInteger('id_board');
		    $table->unsignedInteger('id_user');

        $table->foreign('id_board')->references('id')->on('BOARDS');
        $table->foreign('id_user')->references('id')->on('USERS');

		    $table->timestamps();

		});

		Schema::create('MEMBER_OF_CARDS', function(Blueprint $table) {
		    $table->unsignedInteger('id_user');
		    $table->unsignedInteger('id_card');

        $table->foreign('id_user')->references('id')->on('USERS');
        $table->foreign('id_card')->references('id')->on('CARDS');

		    $table->timestamps();

		});

		Schema::create('MEMBER_OF_PROJECTS', function(Blueprint $table) {
		    $table->unsignedInteger('id_user');
		    $table->unsignedInteger('id_project');

        $table->foreign('id_user')->references('id')->on('USERS');
        $table->foreign('id_project')->references('id')->on('PROJECTS');

		    $table->timestamps();

		});

		Schema::create('MEMBER_OF_TASKS', function(Blueprint $table) {
		    $table->unsignedInteger('id_user');
		    $table->unsignedInteger('id_task');

        $table->foreign('id_user')->references('id')->on('USERS');
        $table->foreign('id_task')->references('id')->on('TASKS');

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
		Schema::drop('NOTIFICATION');

    }
}
