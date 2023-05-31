<?php

function display_flash_message(){
    if (isset($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $type => $message) {
            echo "<div class='alert alert-$type'>$message</div>";
        }
        unset($_SESSION['flash']);
    }
}