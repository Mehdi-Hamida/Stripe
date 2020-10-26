<?php

require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('pk_test_51HcVdjI67jSx3KHkdH0yfPTnZESOsTcxePl3UPbuL94J4bpfi9URETrfEOjAjYpgp1kDFjrrZkWu0qQacu8lcVzS00iW31DeXe');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:4242';

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'usd',
      'unit_amount' => 2000,
      'product_data' => [
        'name' => 'Stubborn Attachments',
        'images' => ["https://i.imgur.com/EHyR2nP.png"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.html', /*UNE FOIS LA PAGE SUCCES.HTML HEBERGEE, RENTRER LE LIEN POUR FAIRE LA REDIRECTION*/
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html', /*UNE FOIS LA PAGE CANCEL.HTML HEBERGEE, RENTRER LE LIEN POUR FAIRE LA REDIRECTION*/
]);

echo json_encode(['id' => $checkout_session->id]);

/*EXPLICATIONS : 

Amount : assurez-vous que le montant rentré ici corresponde au montant présent sur le formulaire de paiement

'description' =>  L'intitulé qui sera affiché sur la ligne de débit de compte en banque du client

'receipt_email' => $email   (pour envoyer une confirmation de paiement)

Info: Le mail de confirmation du paiement est envoyé uniquement pour les paiements en mode réel !

src + class : ne pas toucher
data-key : ta clé d'api Stripe
data-amount : le montant affiché sur le formulaire 500 = 5€ ; 1000 = 10€
data-name : le nom de ta marque
data-description : ton produit vendu
data-image : image qui illustre ta marque, ton produit..
data locale : laisser sur auto pour que Stripe traduise la langue du formulaire en fonction des paramètres du navigateur de l'utilisateur
data-currency : les lettres de référence de votre monnaie */