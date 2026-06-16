<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Temporarily change the enum to string (varchar) so we can update the values
        DB::statement("ALTER TABLE siswas MODIFY COLUMN kelas VARCHAR(255) NOT NULL DEFAULT 'VII1'");
        DB::statement("ALTER TABLE mapels MODIFY COLUMN kelas VARCHAR(255) NOT NULL");

        // 2. Map old values to new values
        $mapping = [
            'VII A' => 'VII1', 'VII B' => 'VII2', 'VII C' => 'VII3',
            'VIII A' => 'VIII1', 'VIII B' => 'VIII2', 'VIII C' => 'VIII3',
            'IX A' => 'IX1', 'IX B' => 'IX2', 'IX C' => 'IX3',
        ];

        foreach ($mapping as $old => $new) {
            DB::table('siswas')->where('kelas', $old)->update(['kelas' => $new]);
            DB::table('mapels')->where('kelas', $old)->update(['kelas' => $new]);
        }

        // 3. Change back to the new enum
        DB::statement("ALTER TABLE siswas MODIFY COLUMN kelas ENUM('VII1', 'VII2', 'VII3', 'VIII1', 'VIII2', 'VIII3', 'IX1', 'IX2', 'IX3') NOT NULL DEFAULT 'VII1'");
        DB::statement("ALTER TABLE mapels MODIFY COLUMN kelas ENUM('VII1', 'VII2', 'VII3', 'VIII1', 'VIII2', 'VIII3', 'IX1', 'IX2', 'IX3') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Temporarily change the enum to string (varchar)
        DB::statement("ALTER TABLE siswas MODIFY COLUMN kelas VARCHAR(255) NOT NULL DEFAULT 'VII A'");
        DB::statement("ALTER TABLE mapels MODIFY COLUMN kelas VARCHAR(255) NOT NULL");

        // 2. Map new values to old values
        $mapping = [
            'VII1' => 'VII A', 'VII2' => 'VII B', 'VII3' => 'VII C',
            'VIII1' => 'VIII A', 'VIII2' => 'VIII B', 'VIII3' => 'VIII C',
            'IX1' => 'IX A', 'IX2' => 'IX B', 'IX3' => 'IX C',
        ];

        foreach ($mapping as $new => $old) {
            DB::table('siswas')->where('kelas', $new)->update(['kelas' => $old]);
            DB::table('mapels')->where('kelas', $new)->update(['kelas' => $old]);
        }

        // 3. Change back to the old enum
        DB::statement("ALTER TABLE siswas MODIFY COLUMN kelas ENUM('VII A', 'VII B', 'VII C', 'VIII A', 'VIII B', 'VIII C', 'IX A', 'IX B', 'IX C') NOT NULL DEFAULT 'VII A'");
        DB::statement("ALTER TABLE mapels MODIFY COLUMN kelas ENUM('VII A', 'VII B', 'VII C', 'VIII A', 'VIII B', 'VIII C', 'IX A', 'IX B', 'IX C') NOT NULL");
    }
};
