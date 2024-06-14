<?php

class ColorTerminal {

    const OPEN_CLOSE_COLOR = "1;34"; // Bleu clair
    const TITLE_COLOR = "1;32"; // Vert
    const ERROR_COLOR = "1;31"; // Rouge clair
    const SUCCESS_COLOR = "0;32"; // Vert foncé

    // Fonction pour mettre en couleur le texte
    public static function colorTerminal($text, $colorCode) {
        return "\033[{$colorCode}m{$text}\033[0m";
    }
}
