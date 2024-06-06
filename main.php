<?php
while (true) {
    $line = readline("Entrez votre commande : ");
    switch ($line) {
        case "list":
            echo "affichage de la liste\n";
            break;
        default:
            echo "Vous avez saisi : $line\n";
            break;
    } 
}