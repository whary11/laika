<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';
    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {           
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 45);
            $table->string('email', 45);
            $table->string('email_verified_at', 45)->nullable();
            $table->string('password', 200);
            $table->string('remember_token', 200);
            $table->unsignedInteger('municipality_id');

            $table->index(["municipality_id"], 'municipality_id_idx');

            $table->unique(["id"], 'id_UNIQUE');

            $table->unique(["email"], 'email_UNIQUE');
            $table->timestamps();


            $table->foreign('municipality_id', 'municipality_id_idx')
                ->references('id')->on('municipalities')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
