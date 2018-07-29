<?php
include 'Config.php';

if (get_magic_quotes_gpc()) {
    $_POST = mixed_stripslashes($_POST);
}

$dsn = Config::DB_CONNECTOR . ':host=' . Config::DB_HOST .';dbname=' . Config::DB_NAME;
$username = Config::DB_USER;
$passwd = Config::DB_PASS;
$options = NULL;

try {
    $db = new PDO($dsn, $username, $passwd, $options);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("SET CHARACTER SET utf8");
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

/**
 * Un strislashes récursif qui échappe les valeurs mais aussi les clés des tableaux.
 * @param mixed $mixed Le contenu échappé à nettoyer.
 * @return mixed le contenu nettoyé de ses échappements.
 */
function mixed_stripslashes($mixed) {
    if (is_array($mixed)) {
        $cleanMixed = array();
        foreach ($mixed as $key => $value) {
            $cleanMixed[stripslashes($key)] = mixed_stripslashes($value);
        }
        return $cleanMixed;
    } else {
        return stripslashes($mixed);
    }
}
