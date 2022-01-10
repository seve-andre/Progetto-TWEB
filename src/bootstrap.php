<?php
session_start();
define("PRODUCTS_DIR", "./img/products/");
require_once("util/functions.php");
require("php/category.php");
require_once("db/db_helper.php");
$db_helper = new DataBaseHelper("localhost", "root", "", "eat_up", 3306);
define("IMG_PATH", "./img/");
