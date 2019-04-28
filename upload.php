<?php

$errors = [];
$authorizedTypes = ["image/jpeg", "image/png", "image/gif"];

if(isset($_FILES['files']))
{
    $directory = 'img/';
    $fileName = basename($_FILES['files']['name']);
    if(move_uploaded_file($_FILES['files']['tmp_name'], $directory . $fileName))     {
        echo 'Upload effectué avec succès !';
    } else {
        echo 'Echec du téléchargement !';
    }
}

die();

$maxSize = 1000000;


if (!empty($_FILES['files']['name'][0])) {

    $files = $_FILES['files'];
}


foreach ($_FILES["files"]["type"] as $types => $type) {
    if (!in_array($type, $authorizedTypes)) {
        $errors["type"] = "Type de fichier invalide";
    }
}

foreach ($_FILES["files"]["size"] as $sizes => $size) {
    if ($size > $maxSize) {
        $errors["size"] = "Taille trop importante";
    }
}




if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "Errors : " . $error;
    }
} else {
    echo "Tout s'est bien passé, cool non ?";
}