<?php
    require_once("controller/controllerSite.php");
    $action = "acceuil";
    if (isset($_GET["action"]) && in_array($_GET["action"],get_class_methods("controllerSite")))
        $action = $_GET["action"];

    require_once("view/header.html");
    controllerSite::$action();
    require_once("view/footer.html");
?>
