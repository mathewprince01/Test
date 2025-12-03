<?php

use App\Models\City;
use App\Models\Country;
use App\Models\Organizer;
use App\Models\TicketInventory;
use App\Models\TicketPurchase;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_id',10);

            $table->string('event_name');
            $table->date('event_date');
            $table->time('event_time');
            $table->text('venue');
            $table->string('city');
            $table->string('country');
            $table->string('event_type');
            $table->string('event_banner');
            $table->integer('max_attendees');
            $table->foreignIdFor(Country::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Organizer::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
