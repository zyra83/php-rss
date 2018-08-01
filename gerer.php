<?php
    include "Config.php";
	header("Content-type:text/html; charset=UTF-8");
    $now = date_format(date_create(), "Y-m-d H:i:s")
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gérer les actalités</title>
        <link rel="stylesheet" media="screen" href="static/css/ecran.css">
    </head>
    <body>
        <div id="wrapper">
            <center>
                <h1>- GESTION RSS -</h1>
            </center>
            <div class="formContent">
                <div class="formContent">
                    <h2>Liste des actualités</h2>
                    <ul id="itemList"></ul>
                </div>
            </div>
            <form action="javascript:subForm()">
                <div class="formContent">
                    <h2>&Eacute;diter une actualité</h2>
                    <input type="hidden" id="id" name="id">
                    <label for="channel" title="Fil RSS auquel l'actualité appartient.">
                        <span>Channel</span>
                        <select required id="channel" name="channel"></select>
                    </label>
                    <label for="title" title="Titre de l'actualité.">
                        <span>Titre</span>
                        <input required placeholder="titre" type="text" id="title" name="title">
                    </label>
                    <label for="link" title="Lien web vers lequel pointe l'actualité. Laisser vide si non applicable.">
                        <span>Lien</span>
                        <input placeholder="http://" type="url" id="link" name="link" >
                    </label>
                    <label for="pubDate" title="Date de publication de l'actualité. (YYYY-MM-DD HH:mm)">
                        <span>Date de publication</span>
                        <input required placeholder="<?php echo $now ?>" type="text" id="pubDate" name="pubDate">
                    </label>
                    <label for="description" title="Contenu de l'actualité.">
                        <span>Description</span>
                        <textarea required placeholder="résumé de l'actualité" id="description" name="description"></textarea>
                    </label>
                    <input type="submit" title="Enregistre l'actualité dans le fil RSS." name="enregistrer" value="enregistrer">
                    <input type="reset" title="Vider les champs du formulaire." id="clear-btn" name="clear" value="vider les champs">
                </div>
            </form>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
        <script type="text/javascript" src="static/js/script.js?version=<?php echo date_format(date_create(), "U") ?>" charset="UTF-8"></script>
    </body>
</html>
