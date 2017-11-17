<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>PianoLoveScore - Demande de partition REFUSEE</title>
        <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;}
        .content {width: 100%; max-width: 600px;}  
        </style>
    </head>
    <body>
        Bonjour {{ $score_request->contact_firstname }},
        <br /><br />
        Vous avez demandé à avoir la partition "{{ $score_request->title }}" de {{ $score_request->author }}, cependant votre demande à été refusée pour la raison suivante :
        <br /><br />
        <p><strong>{{ $score_request->admin_message }}</strong></p>
        <br /><br />
        N'hésitez pas à faire à nouveau une demande de partition en inscrivant, si besoin, un commentaire détaillé de votre demande. Celui-ci aidera l'administrateur à trouver la bonne version de la partition que vous recherchez.
        <br /><br />
        A bientôt sur PianoLoveScore.com
        <br />
        ----------------------------------------
        <br />
        Ceci est un email automatique, merci de ne pas y répondre.
    </body>
</html>