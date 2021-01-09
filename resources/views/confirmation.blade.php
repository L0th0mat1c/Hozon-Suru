<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Commande de {{ $data[0] }}</title>
</head>
<body>

<h1>  Vous avez réservé un article chez {{ $data[4] }}.</h1>

<p> Vous pouvez récupérer votre commande entre {{ $data[6] }} et {{ $data[7] }} à l'adresse suivante : {{ $data[1] }}

<p>Vous pouvez le contacter à ce numéro : {{ $data[3] }}</p>

<p>Ou par cette adresse mail : {{ $data[5] }}</p>

<p>Vous lui devez : <strong>{{ $data[2] }}</strong> €</p>

<p> Veuillez noter votre code de sécurité : <strong>{{ $data[8] }}</strong>

<p>Merci de votre confiance !</p>

</body>
</html>








