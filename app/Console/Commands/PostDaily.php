<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Evenement;
use App\Models\Promo;
use App\Models\Publicite;
use Carbon\Carbon;
class PostDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Post:Daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $evenements=Evenement::all();
        foreach ($evenements as $key => $e) {
            if ($e->dateDebut<=Carbon::today()->format('Y-m-d') && $e->dateFin>Carbon::today()->format('Y-m-d')) {
                $e->post=1;
                $e->update();
            }
        }
        $promos=Promo::all();
        foreach ($promos as $key => $e) {
            if ($e->dateDebut<=Carbon::today()->format('Y-m-d') && $e->dateFin>Carbon::today()->format('Y-m-d')) {
                $e->post=0;
                $e->update();
            }
        }
        $publicites=Publicite::all();
        foreach ($publicites as $key => $e) {
            if ($e->dateDebut<=Carbon::today()->format('Y-m-d') && $e->dateFin>Carbon::today()->format('Y-m-d')) {
                $e->post=1;
                $e->update();
            }
        }
}
}