<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>PianoLoveScore - Demande de partition ACCEPTEE</title>
        <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;}
        .content {width: 100%; max-width: 600px;}  
        </style>
    </head>
    <body>
        Bonjour {{ $score_request->contact_firstname }},
        <br /><br />
        Vous avez demandé à avoir la partition "{{ $score_request->score->title }}" de {{ $score_request->score->author->lastname }} et votre demande à été acceptée.
        La partition est maintenant disponible à l'adresse suivante : <a href="{{ route('score', ['slug_author'=>$score_request->score->author->slug, 'slug_score'=>$score_request->score->slug])}}" target="_blank">{{ route('score', ['slug_author'=>$score_request->score->author->slug, 'slug_score'=>$score_request->score->slug])}}</a>
        <br /><br />
        Si le lien ne fonctionne pas, copiez/collez le dans votre navigateur.
        <br /><br />
        A bientôt sur PianoLoveScore.com
        <br />
        ----------------------------------------
        <br />
        Ceci est un email automatique, merci de ne pas y répondre.
    </body>
</html>