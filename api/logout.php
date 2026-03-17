<?php
require_once __DIR__ . "/../config.php";
require_csrf();   // even logout should be CSRF-protected

$_SESSION = [];
if (ini_get("session.use_cookies")) {
  $p = session_get_cookie_params();
  setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
}
session_destroy();
json_out(["ok" => true]);
