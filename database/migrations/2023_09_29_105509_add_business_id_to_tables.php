<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusinessIdToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         $tables = [
            'enquiries' => 'id',
            'media_files' => 'tbl_id',
            'notifications' => 'id',
            'order_histories' => 'order_id',
            'permissions' => 'parent_id',
            'roles' => 'id',
            'units' => 'id',
            'user_emails' => 'id',
            
        ];
         foreach ($tables as $table => $afterColumn) {
            Schema::table($table, function (Blueprint $table) use ($afterColumn) {
                $table->integer('business_id')->nullable()->after($afterColumn);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
