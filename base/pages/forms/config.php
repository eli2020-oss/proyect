<?php
require_once('google-api/vendor/autoload.php');
$gClient = new Google_Client();
$gClient-> setClientId("98915239367-1kc7nngsep1kqbrnfvlcv9933fcqms09.apps.googleusercontent.com");
$gClient-> setClientSecret("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");
$gClient-> setApplicationName("Tickets");
$gClient-> setRedirectUri("http://localhost/proyect/base/pages/forms/controller.php");
$gClient-> addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

$login_url = $gClient-> createAuthUrl();
?>