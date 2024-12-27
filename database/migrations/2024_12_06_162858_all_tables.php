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
        Schema::create('car_brands', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug");
            $table->timestamps();
        });

        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("car_brand_id");
            $table->string("name");
            $table->string("slug");
            $table->timestamps();

            $table->foreign("car_brand_id")->references("id")->on("car_brands")->onDelete('cascade');
        });


        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("price");
            $table->unsignedBigInteger("view_count")->default(0);
            $table->enum("status", ['active', 'removed', 'sold'])->default('active');
            $table->string("phone", 9);
            $table->string("city");
            $table->text("description");
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
        });

        Schema::create('offer_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("offer_id");
            $table->string("path");
            $table->timestamps();

            $table->foreign("offer_id")->references("id")->on("offers")->onDelete('cascade');
        });


        Schema::create('car_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("offer_id");
            $table->unsignedBigInteger("car_model_id");
            $table->string("vin", 17)->unique();
            $table->string("mileage", 9);
            $table->string("prod_year", 4);
            $table->enum("car_type", ['small', 'city', 'compact', 'sedan', 'kombi', 'minivan', 'suv', 'cabrio', 'coupe']);
            $table->enum("drive_type", ['rwd', 'fwd', 'awd', '4wd', 'electric', 'hybrid']);
            $table->enum("fuel_type", ['benzyne', 'benzyne_cng', 'benzyne_lpg', 'diesel', 'electric', 'ethanol', 'hybrid', 'hydrogen']);
            $table->enum("car_condition", ['new', 'used', 'damaged', 'after_accident', 'imported']);
            $table->enum("transmission", ['manual', 'automatic']);
            $table->string("engine_capacity", 4);
            $table->string("engine_power", 4);
            $table->string("color");
            $table->timestamps();

            $table->foreign("car_model_id")->references("id")->on("car_models")->onDelete('cascade');
            $table->foreign("offer_id")->references("id")->on("offers")->onDelete('cascade');
        });

        Schema::create('feature_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string("category_name");
            $table->timestamps();
        });

        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string("feature_name");
            $table->unsignedBigInteger("category_id");
            $table->timestamps();

            $table->foreign("category_id")->references("id")->on("feature_categories")->onDelete('cascade');
        });

        Schema::create('car_detail_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("car_detail_id");
            $table->unsignedBigInteger("feature_id");
            $table->timestamps();

            $table->foreign("car_detail_id")->references("id")->on("car_details")->onDelete('cascade');
            $table->foreign("feature_id")->references("id")->on("features")->onDelete('cascade');
        });

        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("offer_id");
            $table->timestamps();
            $table->unique(['user_id', 'offer_id']);

            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("offer_id")->references("id")->on("offers")->onDelete('cascade');
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sender_id");
            $table->unsignedBigInteger("receiver_id");
            $table->unsignedBigInteger("offer_id");
            $table->boolean("archived")->default(false);
            $table->boolean("read")->default(false);
            $table->text('message');
            $table->timestamps();

            $table->foreign("sender_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("receiver_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("offer_id")->references("id")->on("offers")->onDelete('cascade');
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("seller_id");
            $table->decimal('rating', 2, 1);
            $table->text('review_text')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_brands');
        Schema::dropIfExists('car_models');
        Schema::dropIfExists('offer_images');
        Schema::dropIfExists('car_details');
        Schema::dropIfExists('offers');
        Schema::dropIfExists('feature_categories');
        Schema::dropIfExists('features');
        Schema::dropIfExists('offer_features');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('reviews');
    }
};
