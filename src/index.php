<?php
require_once("bootstrap.php");

$template_params["title"] = "Benvenuto";
$template_params["name"] = "index-template.php";
$template_params["css"] = array("index");
$template_params["js"] = array("index");

require("template/base-template.php");