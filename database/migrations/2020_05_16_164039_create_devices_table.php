<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table): void {
            $table->id();
            $table->string('namespace')->unique();
            $table->string('external_id');
            $table->string('app_id', 32);
            $table->foreign('app_id')->references('id')->on('apps')->cascadeOnDelete();

            $table->string('name')->nullable();
            $table->json('metadata')->nullable();
            $table->json('tags')->nullable();
            $table->actor('owner');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['external_id', 'app_id', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
}
