<?php
if (!empty($_GET["p"])) {
    include_once($_GET["p"]);
} else {
    include "temp/main.php";
}