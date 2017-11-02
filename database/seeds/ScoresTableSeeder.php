<?php
use App\Models\Score;
use Illuminate\Database\Seeder;

class ScoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scores')->delete();

        Score::create([
        	'slug' 					=> 'etude_n_1_op_34',
        	'title'					=> 'Etude n°1 op n°34',
        	'author_id'				=> '1',
        	'score_image'			=> 'http://cdn.imslp.org/images/thumb/pdfs/80/e39ebbba8a007b986d22e571e43186ebb5c0c2d7.png',
        	'score_url'				=> 'http://hz.imslp.info/files/imglnks/usimg/8/80/IMSLP86359-PMLP02344-chopin-24-prel.pdf',
        	'score_sound_format'	=> 'mp3',
        	'score_sound_url'		=> 'http://petrucci.mus.auth.gr/imglnks/usimg/0/0f/IMSLP110289-PMLP02344-08_Chopin-_Prelude_no._1_in_C_major.mp3',
        	'avg_votes'				=> null
        ]);
        Score::create([
            'slug'                  => 'etude_n_2_op_34',
            'title'                 => 'Etude n°2 op.34',
            'author_id'             => '1',
            'score_image'           => 'http://cdn.imslp.org/images/thumb/pdfs/80/e39ebbba8a007b986d22e571e43186ebb5c0c2d7.png',
            'score_url'             => 'http://hz.imslp.info/files/imglnks/usimg/8/80/IMSLP86359-PMLP02344-chopin-24-prel.pdf',
            'score_sound_format'    => 'mp3',
            'score_sound_url'       => 'http://petrucci.mus.auth.gr/imglnks/usimg/0/0f/IMSLP110289-PMLP02344-08_Chopin-_Prelude_no._1_in_C_major.mp3',
            'avg_votes'             => null
        ]);
        Score::create([
            'slug'                  => 'etude_n_3_op_34',
            'title'                 => 'Etude n°3 op.34',
            'author_id'             => '1',
            'score_image'           => 'http://cdn.imslp.org/images/thumb/pdfs/80/e39ebbba8a007b986d22e571e43186ebb5c0c2d7.png',
            'score_url'             => 'http://hz.imslp.info/files/imglnks/usimg/8/80/IMSLP86359-PMLP02344-chopin-24-prel.pdf',
            'score_sound_format'    => 'mp3',
            'score_sound_url'       => 'http://petrucci.mus.auth.gr/imglnks/usimg/0/0f/IMSLP110289-PMLP02344-08_Chopin-_Prelude_no._1_in_C_major.mp3',
            'avg_votes'             => null
        ]);
        Score::create([
            'slug'                  => 'prelude_n_4_op_51',
            'title'                 => 'Prelude n°4 op.51',
            'author_id'             => '1',
            'score_image'           => 'http://cdn.imslp.org/images/thumb/pdfs/80/e39ebbba8a007b986d22e571e43186ebb5c0c2d7.png',
            'score_url'             => 'http://hz.imslp.info/files/imglnks/usimg/8/80/IMSLP86359-PMLP02344-chopin-24-prel.pdf',
            'score_sound_format'    => 'mp3',
            'score_sound_url'       => 'http://petrucci.mus.auth.gr/imglnks/usimg/0/0f/IMSLP110289-PMLP02344-08_Chopin-_Prelude_no._1_in_C_major.mp3',
            'avg_votes'             => null
        ]);
        Score::create([
            'slug'                  => 'prelude_n_7_op_53',
            'title'                 => 'Prelude n°7 op.53',
            'author_id'             => '1',
            'score_image'           => 'http://cdn.imslp.org/images/thumb/pdfs/80/e39ebbba8a007b986d22e571e43186ebb5c0c2d7.png',
            'score_url'             => 'http://hz.imslp.info/files/imglnks/usimg/8/80/IMSLP86359-PMLP02344-chopin-24-prel.pdf',
            'score_sound_format'    => 'mp3',
            'score_sound_url'       => 'http://petrucci.mus.auth.gr/imglnks/usimg/0/0f/IMSLP110289-PMLP02344-08_Chopin-_Prelude_no._1_in_C_major.mp3',
            'avg_votes'             => null
        ]);
        Score::create([
            'slug'                  => 'fantaisie_impromptu',
            'title'                 => 'Fantaisie Impromptu',
            'author_id'             => '1',
            'score_image'           => 'http://cdn.imslp.org/images/thumb/pdfs/80/e39ebbba8a007b986d22e571e43186ebb5c0c2d7.png',
            'score_url'             => 'http://hz.imslp.info/files/imglnks/usimg/8/80/IMSLP86359-PMLP02344-chopin-24-prel.pdf',
            'score_sound_format'    => 'mp3',
            'score_sound_url'       => 'http://petrucci.mus.auth.gr/imglnks/usimg/0/0f/IMSLP110289-PMLP02344-08_Chopin-_Prelude_no._1_in_C_major.mp3',
            'avg_votes'             => null
        ]);
    }
}
