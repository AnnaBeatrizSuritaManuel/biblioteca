<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'bibliotec');
define('DB_USER', 'root');
define('DB_PASS', '');

define('Bibliotec', 'Bibliotec');
define('SITE_DESCRIPTION', 'A biblioteca com parceria da Etec Maria Cristina Medeiros');

define('BASE_URL', 'http://localhost/biblioteca');

function redirect($url) {
    header("Location: $url");
    exit;
}

function debug($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
?>