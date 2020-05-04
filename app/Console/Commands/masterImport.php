<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

use App\Dzongkhag;

class masterImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'master:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To import all the Master';

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
        $this->importdzongkhags("tbl_dzongkhags", new Dzongkhag);

    }
    
  public function importdzongkhags() {
    if (($handle = fopen ( public_path () . '/master/tbl_dzongkhags.csv', 'r' )) !== FALSE) {
        $this->line("Importing dzongkhags master data");
        $i=0;
        while ( ($data = fgetcsv ( $handle, 100, ',' )) !== FALSE ) {
            $data = [
                'id' => $data[0],
                'code' => $data[1],
                'dzongkhag' => $data[2],
                  ];
             try {
                if(Dzongkhag::firstOrCreate($data)) {
                    $i++;
                }
            } catch(\Exception $e) {
                $this->error('Something went wrong!'.$e);
                return;

            }
        }

    fclose ( $handle );
    $this->line($i." entries successfully added in the dzongkhag table.");
    }

  }


}
