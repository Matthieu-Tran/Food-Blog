<?php

    require_once("conf/Connexion.php");
    require_once("controller/controllerCommentaire.php");
    Connexion::connect();
    $action = isset($_GET["action"]) ? $_GET["action"] : "read";
    ControllerCommentaire::$action();
    //Je fais un test

?>
