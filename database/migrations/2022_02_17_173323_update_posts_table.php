<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('posts', function (Blueprint $table) {
      $table->foreignId("category_id")->nullable()->constrained()->onDelete('set null');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('posts', function (Blueprint $table) {
      $table->dropForeign(['category_id']); //eliminare il vincolo della foreign key per permettere l'eliminazione della colonna
      $table->dropColumn('catecory_id');
    });
  }
}
