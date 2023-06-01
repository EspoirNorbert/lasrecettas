<?php

function display_flash_message(){
    if (isset($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $type => $message) {
            echo "<div class='alert-dismissible alert alert-$type fade show' role='alert'>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            $message</div>";
        }
        unset($_SESSION['flash']);
    }
}

function block_access(){
    if (!isset($_SESSION['LOGGED_USER'])){
        $_SESSION['flash']["warning"] = "Vous n'etes pas autorisé à acceder à cette page";
        http_response_code(403);
        header("Location: ../login.php");
    }
}

function authMiddleware(){
    if (isset($_SESSION['LOGGED_USER'])){
        http_response_code(403);
        header("Location: auth");
    }
}

function getLoggedUserInfo($info){
    if (isset($_SESSION['LOGGED_USER'])){
        return $_SESSION['LOGGED_USER'][$info];
    }
    return NULL;
}