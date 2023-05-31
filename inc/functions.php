<?php

function display_flash_message(){
    if (isset($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $type => $message) {
            echo "<div class='alert alert-$type' role='alert'>$message</div>";
        }
        unset($_SESSION['flash']);
    }
}

function getLoggedUserInfo($info){
    if (isset($_SESSION['LOGGED_USER'])){
        return $_SESSION['LOGGED_USER'][$info];
    }
    return NULL;
}