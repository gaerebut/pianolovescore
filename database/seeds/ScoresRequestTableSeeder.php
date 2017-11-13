<?php
use App\Models\ScoreRequest;
use Illuminate\Database\Seeder;

class ScoresRequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scores_requests')->delete();

        ScoreRequest::create([
        	'title' 			=> 'Nocture n°2 Op.9',
        	'author'			=> 'Chopin',
        	'contact_lastname'	=> 'REBUT',
        	'contact_firstname'	=> 'Gaëtan',
        	'contact_email'		=> 'gaetan.rebut@gmail.com',
        	'contact_message'	=> 'Avez-vous la version originale ? Merci!'
        ]);
    }
}
