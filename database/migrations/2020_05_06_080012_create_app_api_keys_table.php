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

class CreateAppApiKeysTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('app_api_keys', function (Blueprint $table): void {
            $table->string('id', 64)->primary();
            $table->string('type');
            $table->string('name');
            $table->string('app_id', 32);
            $table->foreign('app_id')->references('id')->on('apps')->cascadeOnDelete();
            $table->timestamp('invalidated_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_api_keys');
    }
}
