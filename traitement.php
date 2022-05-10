<?php
var_dump($_FILES);

//on vérifie si c'est bien une méthode post.
var_dump($_SERVER["REQUEST_METHOD"]);
var_dump($_POST);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit_btn"])) {

    if ($_FILES["fichier"]["error"] !== 0) {
            die; //on casse, on stop ici. 
        }
        $sizeMax = 2 * 1_046_576; // 2mo les _ ne sont pas pris en compte. 

        if ($_FILES["fichier"]["size"] > $sizeMax) {
            die; //on stop.
        }

        $authorizedExt = ["jpg", "png", "webp","JPG"];

        $param = explode(".", $_FILES["fichier"]["name"]); // exemple : lkjdsflk . jpg
        $extension = strtolower(end($param)); // vien chercher le jpg .. etc .. 
        
        //on va comparer si l'extension est autorisée.
        if (!in_array($extension, $authorizedExt)) {
            die;
        }

        $filename = time() . bin2hex(random_bytes(48)) . "." . $extension;

        move_uploaded_file($_FILES["fichier"]["tmp_name"], "uploads/" . $filename);
}


?>