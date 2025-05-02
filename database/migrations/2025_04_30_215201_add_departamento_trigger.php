<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Elimina el trigger viejo si existe
        DB::unprepared('DROP TRIGGER IF EXISTS trg_departamento_after_upd;');

        // Crea el trigger que asigna departamento_id y limpia errores
        DB::unprepared(<<<SQL
			CREATE TRIGGER trg_departamento_after_upd
			AFTER INSERT ON departamentos
			FOR EACH ROW
			BEGIN
				UPDATE categorias
				SET departamento_id   = NEW.id,
					validation_errors = JSON_REMOVE(validation_errors, '$.dep_id'),
					validation_status = CASE
						WHEN JSON_LENGTH(JSON_REMOVE(validation_errors, '$.dep_id')) = 0
						THEN 'valid'
						ELSE 'partial'
					END
				WHERE store_id       = NEW.store_id
				AND dep_id         = NEW.dep_id
				AND JSON_EXTRACT(validation_errors, '$.dep_id') IS NOT NULL;
			END;
			SQL
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_departamento_after_upd;');
    }
};
