<?php
/* Protección ataques CSRF */
function CSRF()
{
    session_start();

    if (empty($_SESSION['CSRF'])) {
        if (function_exists('ramdom_bytes')) {
            $_SESSION['CSRF'] = bin2hex(random_bytes(32));
        } else if (function_exists('mcrypt_create_iv')) {
            $_SESSION['CSRF'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URAMDOM));
        } else {
            $_SESSION['CSRF'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
    }
}

/* Codifica cualquier caracter en su versión html */
function escapar($html)
{
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}