#!/usr/bin/env bash

echo "\
\$dentistas = factory(App\Dentistas::class, 4)->create();\
\$dentistas->each(function($a){$a->save();});\
\$pacientes = factory(App\Pacientes::class, 50)->create();\
\$pacientes->each(function($a){$a->save();});\
" > tinkerfile.txt
#->each(function ($a) {$a->save();})
php artisan tinker < ./tinkerfile.txt
rm -f tinkerfile
