<?php

    require_once("controller/controllerSite.php");


    $action = "acceuil";
    if (isset($_GET["action"]) && in_array($_GET["action"],get_class_methods("ControllerVoiture")))
        $action = $_GET["action"];

    controllerSite::$action();

?>
