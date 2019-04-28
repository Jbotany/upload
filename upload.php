<?php

var_dump($_FILES);

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

                //rename file
                $oldNameComplete = $files['name'][$i];
                //TODO


                //save file in directory
                $directory = 'img/';
                $fileName = basename($files['name']);
                if (move_uploaded_file($files['tmp_name'], $directory . $fileName)) {
                    $success = true;
                }

                //if success = true --> Redirection
                //header('Location: redirect.php');
            }




            $tmpFilePath = $files['tmp_name'][$i];
            if ($tmpFilePath != "") {
                $shortName = $files['name'];
            }

            $filePath = "/img/" . $files[$i];
        }


        //challenge :
        //upload multiple
        //utiliser rename() pour renommer un fichier /nom : imageIDUNIQUE.extension
        //bouton delete (fonction unlink) présent
        //fichier uploadés affichés en thumbnails bootstrap avec bouton delete pour chaque
    }
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "Errors : " . $error;
    }
} else {
    echo "Tout s'est bien passé, cool non ?";
}


die();




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




