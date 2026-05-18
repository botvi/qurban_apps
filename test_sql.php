<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$q = App\Models\NilaiQuiz::latest();
$q->whereHas('materi.mapel', function ($q2) {
    $q2->where('kelas', '7');
})->whereHas('materi', function ($q3) {
    $q3->where('mapel_id', '1');
});
echo $q->toSql() . "\n";
