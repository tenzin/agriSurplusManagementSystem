<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

use App\Dzongkhag;
use App\Gewog;
use App\Role;
use App\User;
use App\PermissionRole;
use App\Permission;
use App\Product;
use App\ProductType;
use App\Region;
use App\Unit;
use App\Cunit;
use App\MappingUnit;


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


        $this->importroles("roles", new Role);
        $this->importregions("regions", new Region);
        $this->importdzongkhags("dzongkhags", new Dzongkhag);
        $this->importgeogs("gewogs", new Gewog);
        $this->importusers("users", new User);
        $this->importPermissions("permissions", new Permission);
        $this->importPivot("permission_roles",new PermissionRole, 'permission_id','role_id');
        $this->importproduct_types("product_types", new ProductType);
        $this->importproducts("products", new Product);
        $this->importunits("units", new Unit);
        $this->importcultivationunits("cultivationunits", new Cunit);
        $this->importunit_product_mappings("unit_product_mappings", new MappingUnit);

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

public function importregions($filename, Model $model) {
    if (($handle = fopen ( public_path () . '/master/'.$filename.'.csv', 'r' )) !== FALSE) {
        $this->line("Importing ".$filename." tables...");
        $i=0;
        while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
            $data = [
                'id' => $data[0],
                'region' => $data[1],
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
                    'region_id' => $data[3],
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
                'isAdmin' => ($data[9]=='' ? NULL:$data[9]),
                'isStaff' => ($data[10]=='' ? NULL:$data[10]),
                'username' => $data[11],
                'email' => $data[12],
                'avatar' => ($data[13]=='' ? NULL:$data[13]),
                'email_verified_at' => ($data[14]=='' ? NULL:$data[14]),
                'password' => $data[15],
                'latitude' => ($data[16]=='' ? NULL:$data[16]),
                'longitude' => ($data[17]=='' ? NULL:$data[17]),

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

public function importPermissions($filename, Model $model) {
    if (($handle = fopen ( public_path () . '/master/'.$filename.'.csv', 'r' )) !== FALSE) {
        $this->line("Importing ".$filename." tables...");
        $i=0;
        while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
            $data = [
                'id' => $data[0],
                'name' => $data[1],
                'label' => $data[2],
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
public function importproduct_types($filename, Model $model) {
    if (($handle = fopen ( public_path () . '/master/'.$filename.'.csv', 'r' )) !== FALSE) {
        $this->line("Importing ".$filename." tables...");
        $i=0;
        while ( ($data = fgetcsv ( $handle, 100, ',' )) !== FALSE ) {
            $data = [
                'id' => $data[0],
                'type' => $data[1],
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

public function importPivot($filename, Model $model, $a, $b) {
    if (($handle = fopen ( public_path () . '/master/'.$filename.'.csv', 'r' )) !== FALSE) {
        $this->line("Importing pivot data");
        $i=0;
        while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
          $data = [
          $a => $data[0],
          $b => $data[1],
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

public function importproducts($filename, Model $model) {
    if (($handle = fopen ( public_path () . '/master/'.$filename.'.csv', 'r' )) !== FALSE) {
        $this->line("Importing ".$filename." tables...");
        $i=0;
        while ( ($data = fgetcsv ( $handle, 100, ',' )) !== FALSE ) {
            $data = [
                'id' => $data[0],
                'productType_id' => $data[1],
                'product' => $data[2],
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
    $this->line($i." entries successfully added in the table.");
    }
}

public function importunits($filename, Model $model) {
    if (($handle = fopen ( public_path () . '/master/'.$filename.'.csv', 'r' )) !== FALSE) {
        $this->line("Importing ".$filename." tables...");
        $i=0;
        while ( ($data = fgetcsv ( $handle, 100, ',' )) !== FALSE ) {
            $data = [
                'id' => $data[0],
                'unit' => $data[1],
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
public function importcultivationunits($filename, Model $model) {
    if (($handle = fopen ( public_path () . '/master/'.$filename.'.csv', 'r' )) !== FALSE) {
        $this->line("Importing ".$filename." tables...");
        $i=0;
        while ( ($data = fgetcsv ( $handle, 100, ',' )) !== FALSE ) {
            $data = [
                'id' => $data[0],
                'unit' => $data[1],
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


public function importunit_product_mappings($filename, Model $model) {
    if (($handle = fopen ( public_path () . '/master/'.$filename.'.csv', 'r' )) !== FALSE) {
        $this->line("Importing ".$filename." tables...");
        $i=0;
        while ( ($data = fgetcsv ( $handle, 100, ',' )) !== FALSE ) {
            $data = [
                'id' => $data[0],
                'product_id' => $data[1],
                'unit_id' => ($data[2]=='' ? NULL:$data[2]),
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
