<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGreadsTable extends Migration {

	public function up()
	{
		Schema::create('Greads', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 30);
			$table->string('notes', 100);
		});
	}

	public function down()
	{
		Schema::drop('Greads');
	}
}