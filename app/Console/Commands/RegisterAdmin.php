<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\User;

class RegisterAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to generate a super admin for the system';

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

        $name=$this->getUserName();
        $email=$this->getEmail();
        $password=$this->getUserPassword();


        if(isset($name)&&isset($email)&&isset($password)) {
            $user = new User;
            $user->name=$name;
            $user->email=$email;
            $user->password=Hash::make($password);
            $user->role_id=1;
            if($user->save()) {
                $this->line('Admin user successfully created!');
            } else {
                $this->error('Something went wrong! Please try running the command again');
            }

        } else
        {
            $this->error('All the required fields are not set');
        }


    }

    protected function getUserPassword() {

        $password = $this->secret('Enter password?');
         $confirmpassword=$this->secret('Reconfirm password:');
        if(strcmp($password,$confirmpassword)==0) {
             return $password;
         } else {
            $this->error('Passwords do not match. Please try again!');
            $this->getUserPassword();
         }


    }





    protected function getUserName() {

        return $this->ask('Enter user full name');


    }

    protected function getEmail() {
        return $this->ask('Enter the user email');
    }
}
