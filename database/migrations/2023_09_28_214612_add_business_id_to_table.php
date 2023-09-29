<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusinessIdToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         $tables = [
            'booked_rooms' => 'room_id',
            'customers' => 'user_id',
            'expenses' => 'category_id',
            'expense_categories' => 'name',
            'food_categories' => 'name',
            'food_items' => 'category_id',
            'housekeeping_items' => 'name',
            'housekeeping_orders' => 'room_id',
            'laundry_items' => 'vendor_id',
            'laundry_orders' => 'room_id',
            'laundry_order_items' => 'item_id',
            'orders' => 'reservation_id',
            'order_items' => 'reservation_id',
            'payment_history' => 'user_id',
            'person_lists' => 'reservation_id',
            'products' => 'id',
            'rooms' => 'room_type_id',
            'room_carts' => 'room_id',
            'room_prices' => 'room_type_id',
            'room_types' => 'title',
            'seasons' => 'id',
            'stock_history' => 'room_id',
            'user_logs' => 'user_id',
            'vendors' => 'category_id',
            'vendor_categories' => 'id',
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
