<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('template_name');
            $table->enum('provider', \App\Enums\SMSPanelTypeEnum::values());
            $table->string('parameters');
            $table->string('parameters_title');
            $table->decimal('version')->default(0.1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::table('templates', function (Blueprint $table) {
            $table->unique(['title', 'template_name', 'provider', 'version']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
