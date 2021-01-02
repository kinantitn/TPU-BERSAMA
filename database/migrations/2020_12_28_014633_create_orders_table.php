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
            $table->unsignedBigInteger('user_id');
            $table->string('token');
            $table->string('customer_type');
            $table->string('name_applicant');
            $table->string('phone_applicant');
            $table->string('funeral_relation');
            $table->string('name_funeral');
            $table->integer('age_funeral');
            $table->string('gender_funeral');
            $table->string('religion_funeral');
            $table->string('address_funeral');
            $table->date('date_funeral');
            $table->string('name_heir')->nullable()->default(null);
            $table->string('address_heir')->nullable()->default(null);
            $table->string('funeral_relation_heir')->nullable()->default(null);

            $table->string('payment_method');
            $table->string('payment_status')->default('PENDING');
            $table->string('status')->default('PENDING');
            $table->decimal('total_price', 20, 2);

            //FUNERAL DATA
            $table->unsignedBigInteger('funeral_id');
            $table->string('funeral_type');
            $table->string('funeral_class');
            $table->string('funeral_number');

            //FILE
            $table->string('identity_applicant');
            $table->string('family_applicant');
            $table->string('identity_funeral');
            $table->string('certificate_funeral')->nullable()->default(null);
            $table->string('permit_life_funeral')->nullable()->default(null);
            $table->string('family_funeral')->nullable()->default(null);
            $table->string('identity_heir')->nullable()->default(null);
            $table->string('family_heir')->nullable()->default(null);
            $table->string('not_capable_funeral')->nullable()->default(null);
            $table->string('payment_file')->nullable()->default(null);
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
