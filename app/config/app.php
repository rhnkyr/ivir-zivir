<?php
$req = $app->request();

define("BASE", $req->getUrl() . "/");
define("IP", $req->getIp());
define("BROWSER", $req->getUserAgent());
define("RURL", $req->getResourceUri()); //route bulur
define("FURL", $req->getPath()); //Full url