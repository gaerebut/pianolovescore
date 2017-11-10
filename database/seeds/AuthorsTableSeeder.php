<?php
use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->delete();

        Author::create([
        	'slug' 		=> 'chopin',
        	'firstname'	=> 'Frédéric',
        	'lastname'	=> 'Chopin',
        	'fullname'	=> 'Frédéric Chopin',
            'birthday'  => '1810-03-01'
        ]);

        Author::create([
            'slug'      => 'beethoven',
            'firstname' => 'Ludwig van',
            'lastname'  => 'Beethoven',
            'fullname'  => 'Ludwig van Beethoven',
            'birthday'  => '1770-03-01'
        ]);
    }
}
