<?php

// Liste des couleurs
$openCloseColor = "1;34"; // Bleu clair
$titleColor = "1;32"; // Vert
$errorColor = "1;31"; // Rouge clair
$successColor = "0;32"; // Vert foncé

// Fonction pour mettre en couleur le texte
function colorerTerminal($text, $colorCode) {
    return "\033[{$colorCode}m{$text}\033[0m";
}
