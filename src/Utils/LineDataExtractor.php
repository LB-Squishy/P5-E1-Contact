<?php

require_once __DIR__ . '/ColorTerminal.php';

class LineDataExtractor {

    public static function lineDataExtractor($line) {

        $commandName = null;
        $id = null;
        $name = null;
        $email = null;
        $phone_number = null;
    
        // Utilisation de preg_match pour extraire la valeur de detail
        if (preg_match('/^detail (\d+)$/', $line, $matches)) {
            $commandName = 'detail';
            $id = $matches[1];
        // Utilisation de preg_match pour extraire les valeurs de creat, traite les virgules et espaces
        } elseif (preg_match('/^creat (.+)$/', $line, $matches)) {
            $commandName = 'creat';
            $params = explode(',', $matches[1]);
            $params = array_map('trim', $params);
            if (count($params) === 3) {
                list($name, $email, $phone_number) = $params;
            } else {
                echo ColorTerminal::colorTerminal("\n" . "PROCESSUS DE CREATION DE CONTACT : " . "\n", ColorTerminal::TITLE_COLOR);
                echo ColorTerminal::colorTerminal("\n" . "Il manque une des trois données" . "\n" . "Utilisez la commande comme ceci : creat [name], [email], [phone_number] - ex : 'creat Buffy Summer, buffy@sunnydale.com, 01091901' ." . "\n", ColorTerminal::ERROR_COLOR);
                return "missCreatData";
            }
        // A default de valeur utiliser le nom de la commande saisi
        } else {
            $commandName = $line;
        }
        return [
            'commandName' => $commandName,
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number,
        ];
    }
}