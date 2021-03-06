<?php
// To mitigate xss
// IMP uncomments the line bellow when hosting (not localhost)
// session_set_cookie_params(0, '/', '.up.pt', true, true);

session_start();

// Prevents session fixation attacks
// Make sure the following are set in your php.ini file (both are the defaults):
// session.use_only_cookies = 1
// session.use_trans_sid = 0
session_regenerate_id(true);

function generate_random_token()
{
  return bin2hex(openssl_random_pseudo_bytes(32));
}

if (!isset($_SESSION['csrf'])) {
  $_SESSION['csrf'] = generate_random_token();
}
?>
