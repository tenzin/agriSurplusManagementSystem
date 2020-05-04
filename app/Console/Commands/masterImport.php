<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

use App\Dzongkhag;
use App\Gewog;
use App\Role;
use App\User;


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
        $this->importusers("users", new User);
        $this->importroles("roles", new Role);
        $this->importdzongkhags("dzongkhags", new Dzongkhag);
        $this->importgeogs("gewogs", new Gewog);

    }

    public function importusers($filename, Model $model) {
        if (($handle = fopen ( public_path () . '/master/'.$filename.'.csv', 'r' )) !== FALSE) {
            $this->line("Importing ".$filename." tables...");
            $i=0;
            while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
                $data = [
                    'id' => $data[0],
                    'cid' => $data[1],
                    'name' => $data[2],
                    'dzongkhag_id' => $data[3],
                    'gewog_id' => $data[4],
                    'address' => $data[5],
                    'contact_number' => $data[6],
                    'role_id' => $data[7],
                    'isActive' => $data[8],
                    'isAdmin' => $data[9],
                    'isStaff' => $data[10],
                    'username' => $data[11],
                    'email' => $data[12],
                    'email_verified_at' => ($data[13]=='' ? NULL:$data[13]),
                    'password' => $data[14],
    
                ];
                 try {
                    if($model::firstOrCreate($data)) {
                        $i++;
                    }
                } catch(\Exception $e) {
                    $this->error('Something went wrong!'.$e);
                    return;
    
                }
            }
    
        fclose ( $handle );
        $this->line($i." entries successfully added in the ".$filename." table.");
    }
    
    }
    

    public function importroles($filename, Model $model) {
        if (($handle = fopen ( public_path () . '/master/'.$filename.'.csv', 'r' )) !== FALSE) {
            $this->line("Importing ".$filename." tables...");
            $i=0;
            while ( ($data = fgetcsv ( $handle, 100, ',' )) !== FALSE ) {
                $data = [
                    'id' => $data[0],
                    'role' => $data[1],
                ];
                 try {
                    if($model::firstOrCreate($data)) {
                        $i++;
                    }
                } catch(\Exception $e) {
                    $this->error('Something went wrong!'.$e);
                    return;

                }
            }

        fclose ( $handle );
        $this->line($i." entries successfully added in the ".$filename." table.");
    }
}
    public function importdzongkhags($filename, Model $model) {
        if (($handle = fopen ( public_path () . '/master/'.$filename.'.csv', 'r' )) !== FALSE) {
            $this->line("Importing ".$filename." tables...");
            $i=0;
            while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
                $data = [
                    'id' => $data[0],
                    'code' => $data[1],
                    'dzongkhag' => $data[2],
                ];
                 try {
                    if($model::firstOrCreate($data)) {
                        $i++;
                    }
                } catch(\Exception $e) {
                    $this->error('Something went wrong!'.$e);
                    return;

                }
            }

        fclose ( $handle );
        $this->line($i." entries successfully added in the ".$filename." table.");
    }

}
public function importgeogs($filename, Model $model) {
    if (($handle = fopen ( public_path () . '/master/'.$filename.'.csv', 'r' )) !== FALSE) {
        $this->line("Importing ".$filename." tables...");
        $i=0;
        while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
            $data = [
                'id' => $data[0],
                'code' => $data[1],
                'dzongkhag_id' => $data[2],
                'gewog' => $data[3],
                'latitude' => ($data[4]=='' ? NULL:$data[4]),
                'longitude' => ($data[5]=='' ? NULL:$data[5]),

            ];
             try {
                if($model::firstOrCreate($data)) {
                    $i++;
                }
            } catch(\Exception $e) {
                $this->error('Something went wrong!'.$e);
                return;

            }
        }

    fclose ( $handle );
    $this->line($i." entries successfully added in the ".$filename." table.");
}

}

}
