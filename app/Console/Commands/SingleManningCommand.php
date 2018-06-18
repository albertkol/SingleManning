<?php

namespace App\Console\Commands;

use App\Helpers\SingleManning;
use App\Rota;
use Illuminate\Console\Command;

class SingleManningCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'singlemanning:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate single manning hours command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $rota = Rota::find(1);

        foreach(SingleManning::calculate($rota) as $date => $info){
            $this->info("{$date}: {$info['single_manning_hours']} single manning hours");
        }
    }
}
