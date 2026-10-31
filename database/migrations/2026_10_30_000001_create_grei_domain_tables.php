<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false);
        });

        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('kind')->index();
            $table->string('category')->index();
            $table->string('property_type')->index();
            $table->string('location')->index();
            $table->string('address')->nullable();
            $table->text('summary');
            $table->text('description');
            $table->unsignedSmallInteger('bedrooms')->default(0);
            $table->unsignedSmallInteger('bathrooms')->default(0);
            $table->unsignedSmallInteger('guest_capacity')->nullable();
            $table->decimal('area_sqm', 10, 2)->nullable();
            $table->unsignedBigInteger('price_minor')->nullable();
            $table->char('currency', 3)->default('NGN');
            $table->string('price_period')->nullable();
            $table->unsignedSmallInteger('min_nights')->default(1);
            $table->unsignedSmallInteger('max_nights')->default(90);
            $table->json('amenities')->nullable();
            $table->string('cover_asset')->nullable();
            $table->string('video_url', 1000)->nullable();
            $table->string('status')->default('draft')->index();
            $table->boolean('featured')->default(false);
            $table->boolean('is_demo')->default(false)->index();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['kind', 'status', 'category']);
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->index();
            $table->string('location')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->text('summary');
            $table->text('story');
            $table->text('approach')->nullable();
            $table->json('services')->nullable();
            $table->json('materials')->nullable();
            $table->string('cover_asset')->nullable();
            $table->string('status')->default('draft')->index();
            $table->boolean('featured')->default(false);
            $table->boolean('is_demo')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->morphs('mediable');
            $table->string('path');
            $table->string('original_name');
            $table->string('mime_type');
            $table->string('kind');
            $table->string('alt')->nullable();
            $table->unsignedBigInteger('size');
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('availability_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->cascadeOnDelete();
            $table->date('starts_on');
            $table->date('ends_on');
            $table->string('note')->nullable();
            $table->timestamps();
            $table->index(['listing_id', 'starts_on', 'ends_on']);
        });

        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->uuid('reference')->unique();
            $table->uuid('submission_token')->unique();
            $table->string('payload_hash', 64);
            $table->string('service')->index();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->foreignId('listing_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->date('checkin')->nullable();
            $table->date('checkout')->nullable();
            $table->unsignedSmallInteger('guests')->nullable();
            $table->text('message');
            $table->string('status')->default('new')->index();
            $table->text('admin_notes')->nullable();
            $table->timestamp('consented_at');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('site_settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('enquiries');
        Schema::dropIfExists('availability_blocks');
        Schema::dropIfExists('media');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('listings');
        Schema::table('users', fn (Blueprint $table) => $table->dropColumn('is_admin'));
    }
};
