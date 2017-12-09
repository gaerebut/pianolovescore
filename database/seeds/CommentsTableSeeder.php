<?php
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();

        Comment::create([
        	'parent_id' => null,
            'score_id'  => 6,
            'username'  => 'gaerebut',
            'comment'   => 'Excellente partition ! Merci :)',
            'ip_address'=> '127.0.0.1'
        ]);

        Comment::create([
            'parent_id' => null,
            'score_id'  => 6,
            'username'  => 'gaerebut',
            'comment'   => 'Comment peut-on réussir à jouer ceci o_O"',
            'ip_address'=> '127.0.0.1'
        ]);

        Comment::create([
            'parent_id' => 2,
            'score_id'  => 6,
            'username'  => 'pianovice',
            'comment'   => 'Il faut penser 5 pour 6 ! Les 2 mains jouent rarement ensemble. Il faut commencer séparément puis très lentement ensemble. Une fois le truc trouvé, vous pouvez accélérer :)',
            'ip_address'=> '127.0.0.32'
        ]);
    }
}
