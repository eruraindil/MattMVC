<?php

$url = parse_url(substr($_SERVER["REQUEST_URI"], 1));
if (isset($url["path"])) {
  $route = $url["path"];
} else {
  $route = "";
}

if (is_file($route)) {
    if(substr($route, -4) == ".php"){
        require $route;         // Include requested script files
        exit;
    }
    return false;               // Serve file as is
} else {                        // Fallback to index.php
    $_GET["url"] = $route;        // Try to emulate the behaviour of your htaccess here, if needed
    require "index.php";
}
