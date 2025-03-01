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
        Schema::create('audit_virement', function (Blueprint $table) {
            $table->id();
            $table->enum('type_action', ['ajout', 'suppression', 'modification']);
            $table->timestamp('date_operation')->useCurrent();
            $table->integer('numero_virement');
            $table->string('numero_compte');
            $table->string('nom_client');
            $table->timestamp('date_virement');
            $table->integer('montant_ancien');
            $table->integer('montant_nouv');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_virement');
    }
};
