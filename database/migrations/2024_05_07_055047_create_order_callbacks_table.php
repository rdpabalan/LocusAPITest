<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_callbacks', function (Blueprint $table) {
            $table->string('id');
            $table->date('date');
            $table->string('order_status')->default('default_value');
            $table->string('order_sub_status')->nullable();
            $table->datetime('trigger_time');
            $table->decimal('lat', 18, 15);
            $table->decimal('lng', 18, 15);
            $table->string('team_id');
            $table->string('homebase_id');
            $table->string('location_id');
            $table->string('rider_id');
            $table->string('rider_name');
            $table->string('vehicle_id');
            $table->datetime('current_eta')->nullable();
            $table->timestamp('timestamp')->nullable();
            $table->timestamps(); // Disable Laravel's default timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_callbacks');
    }
};
