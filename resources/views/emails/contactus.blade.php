<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>PianoLoveScore - Contact</title>
        <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;}
        .content {width: 100%; max-width: 600px;}  
        </style>
    </head>
    <body>
        Message provenant de PianoLoveScore :<br /><br />
        NOM / PRENOM: {{ $contact['contact_lastname'] }} / {{ $contact['contact_firstname'] }}<br />
        EMAIL : {{ $contact['contact_email'] }}<br />
        OBJET : {{ $contact['subject'] }}<br />
        MESSAGE : {{ $contact['message'] }}<br />
        ----------------------------------------
        <br />
        Ceci est un email automatique, merci de ne pas y répondre.
    </body>
</html>