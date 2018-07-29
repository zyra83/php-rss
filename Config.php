<?php

/**
 * @author mickael.benoit
 * @version 26/04/2011
 */
class Config {
    const MAINTENANCE = FALSE;
    const MAINTENANCE_PAGE = "maintenance.html"; //Chemin relatif à  la racine de la page de maintenance.
    const HOST = "http://localhost/";

    /*
     * Constantes BASE DE DONNEES
     * requises pour la connexion à la base de données MySQL.
     */
    const DB_CONNECTOR = "mysql";
    const DB_HOST = "127.0.0.1"; //Adresse du serveur MySQL.
    const DB_USER = "root"; //Utilisateur de la BDD.
    const DB_PASS = "root"; //Mot de passe de la BDD.
    const DB_NAME = "zebase"; //Nom de la BDD.

    public static $DB_OPTIONS = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, 
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf-8'
    ); //Options pour la BDD.

    /*
     * Constantes COOKIES
     * En cas d'utilisation de cookie, les domaines et répertoire de validité.
     */
    const COOKIE_EXPIRE = 28800;  //8 heures en secondes
    const COOKIE_PATH = '/';  //Accessible dans tout le domaine
    const COOKIE_DOMAIN = 'localhost';  //Accessible dans tous le domaine

    /*
     * Constantes pour le mailing (mot de passe, inscription...).
     */
    const EMAIL_FROM_NAME = "Administrator"; //Nom d'envoi pour les E-mails
    const EMAIL_FROM_ADDR = "noreply@localhost"; //Adresse d'envoi pour les E-mails
    const EMAIL_TO_ADDR = "Webmestre localhost <noreply@localhost>"; //Adresse de réponse pour les E-mails.

    /*
     * Pour la recherche d'utilisateur sur l'annuaire.
     * L'UID correspond à prénom.nom.
     */
    const ANNUAIRE = "http://annuaire.localhost/index.php?action=recherche&uid=";


    /* Constantes de Dates
     * Pour l'affichage des dates à  l'écran, si il est modifié, le REGEX_DATE_FR doit l'etre aussi. 
     */
    const FORMAT_DATE = "d/m/Y"; //Pour l'affichage des dates à l'écran.
    const FORMAT_DATETIME = "d/m/Y H:i"; //Pour l'affichage des dates-heure à l'écran.

    /*
     * Le format de date que reçois MySQL (format utilisé par PHP date_format pour les insertions).
     */
    const FORMAT_SQL_DATE = "Y-m-d";
    const FORMAT_SQL_DATETIME = "Y-m-d H:i:s";
    const TIME_ZONE = "Europe/Paris"; //Fuseau horaire de l'application.
}
