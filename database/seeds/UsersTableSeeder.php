<?php
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
        	'username' => 'admin',
        	'email'    => 'gaetan.rebut@gmail.com',
        	'password' => Hash::make('admin'),
        	'is_admin' => 1
        ]);
    }
}
