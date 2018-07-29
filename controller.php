<?php
include 'database.php';

$action = "index";
$choix = array("c", "r", "u", "d", "l", "cl");

const FORM_TITLE = 'title';
const FORM_LINK = 'link';
const FORM_PUB_DATE = 'pubDate';
const FORM_DESCR = 'description';
const FORM_CHANNEL = 'channel';

function isSetNotNullNotEmpty($var){
    return ( isset($var) && $var !== NULL && trim($var) !== "" );
}

if (isset($_POST["do"]) && in_array($_POST["do"], $choix)) {
    switch ($_POST["do"]) {
        case "c": // CREATE
        case "u": // UPDATE
            $isUpdate = $_POST['do'] === 'u';
            if($isUpdate){
                $statement = 'UPDATE rss_item SET title = :title, link = :link, pubDate = :pubDate, description = :description, channel_id = :channel_id WHERE id = :id;';
            } else {
                $statement = 'INSERT INTO rss_item (title, link, description, pubDate, channel_id) VALUES (:title, :link, :description, :pubDate, :channel_id);';
            }

            $e->e = null;
            
            try {
                if (    
                    (isSetNotNullNotEmpty($_POST['id']) && ($isUpdate))
                    &&
                    isSetNotNullNotEmpty($_POST[FORM_TITLE])
                    &&
                    isset($_POST[FORM_LINK])
                    &&
                    isSetNotNullNotEmpty($_POST[FORM_PUB_DATE])
                    &&
                    isSetNotNullNotEmpty($_POST[FORM_DESCR])
                    &&
                    isSetNotNullNotEmpty($_POST[FORM_CHANNEL])
                ) {
                    $s = $db->prepare($statement);
                    
                    if($isUpdate){
                        $s->bindValue(':id', $_POST['id']);
                    }

                    $s->bindValue(':title', $_POST[FORM_TITLE]);
                    $s->bindValue(':link', $_POST[FORM_LINK]);
                    $s->bindValue(':pubDate', $_POST[FORM_PUB_DATE]);
                    $s->bindValue(':description', $_POST[FORM_DESCR]);
                    $s->bindValue(':channel_id', $_POST[FORM_CHANNEL]);
                    $s->execute();
                } else {
                    throw new ValidationException("Un champ n'a pas été rempli.");
                }
            } catch (Exception $exc) {
                $e->e = $exc->getMessage();
            }
            echo json_encode($e);
            break;

        case "r": // READ
            $statement = 'SELECT * FROM rss_item WHERE id = :id;';
            $s = $db->prepare($statement);
            $s->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
            if ($s->execute()) {
                $r = $s->fetchAll();
                echo json_encode($r);
            }
            break;
        case "d": // DELETE
            $statement = 'DELETE FROM rss_item WHERE id = :id';
            $s = $db->prepare($statement);
            $s->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
            if ($s->execute()) {
                $r = $s->rowCount();
                echo json_encode($r);
            }
            break;
        case "l": // LIST
            $statement = 'SELECT * FROM rss_item ORDER BY pubDate';
            $s = $db->query($statement);
            $r = $s->fetchAll();
            echo json_encode($r);
            break;
        case "cl": // CHANNELLIST
            $statement = 'SELECT * FROM rss_channel';
            $s = $db->query($statement);
            $r = $s->fetchAll();
            echo json_encode($r);
            break;
        default:
            break;
    }
}
