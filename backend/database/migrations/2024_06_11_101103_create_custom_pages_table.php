<?php

use App\Models\CustomPage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_pages', function (Blueprint $table) {
            $table->id();
            $table->string("name", 16)->unique();
            $table->text("content");
            $table->enum("display", [CustomPage::DISPLAY_NONE, CustomPage::DISPLAY_NAV, CustomPage::DISPLAY_BOTTOM]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_pages');
    }
};
