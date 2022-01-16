<?php
require_once("controller/controllerSite.php");
$action = "acceuil";
if (isset($_GET["action"]) && in_array($_GET["action"], get_class_methods("controllerSite")))
    $action = $_GET["action"];

if (isset($_POST["action"]) && in_array($_POST["action"], get_class_methods("controllerSite")))
    $action = $_POST["action"];

require_once("view/header.php");
controllerSite::$action();
require_once("view/footer.html");
