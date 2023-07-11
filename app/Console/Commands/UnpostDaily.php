<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Evenement;
use App\Models\Promo;
use App\Models\Offer;
use App\Models\Publicite;
use App\Models\Carte;
use Carbon\Carbon;
class UnpostDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Unpost:Daily';

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
        foreach ($evenements as $key => $v) {
            if ($v->dateFin<=Carbon::today()->format('Y-m-d')) {
                $v->post=0;
                $v->update();
            }
        }
        $promos=Promo::all();
        foreach ($promos as $key => $r) {
            if ($r->dateFin<=Carbon::today()->format('Y-m-d')) {
                $r->post=0;
                $r->update();
            }
        }
        $publicites=Publicite::all();
        foreach ($publicites as $key => $p) {
            if ($p->dateFin<=Carbon::today()->format('Y-m-d')) {
                $p->post=0;
                $p->update();
            }
        }
        $cartes=Carte::all();
        foreach ($cartes as $key => $e) {
            if ($e->date<=Carbon::today()->subYear(1)->format('Y-m-d')) {
                $e->is_active=0;
                $e->cause_id=2;
                $e->update();
            }
        }
        $offers=Offer::all();
        foreach ($offers as $key => $o) {
            if ($o->dateFin<=Carbon::today()->format('Y-m-d')) {
                $o->delete();
            }
        }
    }
}
