<?php
// auteur: Lucas Tanis
// functie: algemene functies 

function getTableHeader($row) {
    $headers = array_keys($row);
    $headerTxt = "<tr>";
    foreach($headers as $header){
        $headerTxt .= "<th>" . $header . "</th>";   
    }
    $headerTxt .= "</tr>";
    return $headerTxt;
}
?>