<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUniverstiesTable extends Migration {

	public function up()
	{
		Schema::create('Universties', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 40);
		});
	}

	public function down()
	{
		Schema::drop('Universties');
	}
}