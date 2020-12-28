<?php

    $username = "Admin";
    $password = "Admin1806";
    if( isset($_POST['identifiant']) && isset($_POST['password']) ){
        if($_POST['identifiant'] == $username && $_POST['password'] == $password){ // Si les infos correspondent...
            session_start();
            $_SESSION['user'] = $username;
            echo "Success";
        }
        else{ // Sinon
            echo "Failed";
        }
    }

?>
