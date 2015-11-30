<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        $this->seedUserTable();

        Model::reguard();
    }

    /**
     * omplir taula users
     */
    private function seedUserTable()
    {
        $user = new User();
        $user->name = "Sergi Tur Badenas";
        $user->password = bcrypt(env('PASSWORD_ESTIMAT','1234656'));
        $user->email ="sergiturbadenas@gmail.com";
        $user->save();
    }
}
