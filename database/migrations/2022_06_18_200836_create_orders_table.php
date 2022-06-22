<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // $table->string('invoice_id');
            $table->string('order_id');
            $table->jsonb('billing_address');
            $table->jsonb('shipping_address');
            $table->jsonb('order_details');
            $table->decimal('sub_total', 10, 2);
            $table->decimal('delivery_charge', 6, 2)->nullable()->default(0);
            $table->decimal('discount', 6, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->enum('status', [
                'pending',
                'unanswered',
                'confirmed',
                'paid',
                'on-transit',
                'cancelled',
                'delivered'
            ])->default('pending');
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
