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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            // Relaciones (Claves foráneas)
            // Esto crea la columna 'client_id' y la conecta con la tabla clients
            $table->foreignId('client_id')->constrained()->onDelete('cascade');

            // Esto crea la columna 'plan_id' y la conecta con la tabla plans
            $table->foreignId('plan_id')->constrained();

            $table->date('start_date');
            $table->date('end_date');     // La fecha clave para el acceso
            $table->decimal('price', 10, 2); // Guardamos cuánto pagó (historial)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
