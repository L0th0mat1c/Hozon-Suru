<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Commande de {{ $data[0] }}</title>
</head>
<body>

<h1> {{ $data[0] }} vous a réservé un article.</h1>

<p> Il passera récupérer sa commande entre {{ $data[6] }} et {{ $data[7] }}.

<p>Vous pouvez le contacter à ce numéro : {{ $data[2] }}</p>

<p>Ou par cette adresse mail : {{ $data[1] }}</p>

<p>Il vous reste  : <strong>{{ $data[5] }}</strong> articles sur votre carte de vente</p>

<p> Veuillez noter votre code de sécurité : <strong>{{ $data[8] }}</strong>

<p>Merci de votre confiance !</p>

</body>
</html>