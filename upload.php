<?php

$errors = [];
$authorizedTypes = ["image/jpeg", "image/png", "image/gif"];
$maxFileSize = 1000000;
$success = false;

if (isset($_POST['submit'])) {

    $files = $_FILES['files'];

    if(isset($files)) {

        for ($i = 0; $i < count($files['name']); $i++) {

            //check file type
            if (!in_array($files['type'][$i], $authorizedTypes)) {
                $errors['type'] = "Type de fichier invalide, les fichiers doivent êre du type : .jpeg, .png ou .gif";
            }

            //check file size
            $fileSize = filesize($files['tmp_name'][$i]);
            if ($fileSize > $maxFileSize) {
                $errors['size'][$i] = "La taille du fichier ne doit pas dépasser 1Mo";
            }

            if (!empty($errors)) {
                echo "Erreurs : ";
                echo "<ul>";
                    foreach ($errors as $error) {
                         echo "<li>" . $error . "</li>";
                    }
                echo "</ul>";
            } else {

                //recup extension
                $extension = explode('.', $files['name'][$i]);

                //génère id unique
                $id = uniqid("image");

                //save file in directory
                $directory = __DIR__ .'/img/';
                $fileName = basename($files['name'][$i]);
                move_uploaded_file($files['tmp_name'][$i], $directory . $id . "." . $extension[1]);

                //redirection
                header('Location: redirect.php');
            }
        }
    }
}
