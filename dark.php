<?php
$url = $_SERVER["HTTP_REFERER"];
$styles = json_decode(file_get_contents("colors.json"), true);
$styles["color"] = "dark";

file_put_contents("colors.json",json_encode($styles));

$variable = 11;//juanito xdxd

Header("Location: $url");