<?php
// To mitigate xss
// Importante: manually change domain
session_set_cookie_params(0, '/', '0.0.0.0', true, true);
session_start();

//------------------ Da logout a cada ação que se faça -------------------------

// Prevents session fixation attacks
// session_regenerate_id(true);

// // Make sure the following are set in your php.ini file (both are the defaults):
// // session.use_only_cookies = 1
// // session.use_trans_sid = 0

//-------------------------------------------------------------------------------

function generate_random_token()
{
  return bin2hex(openssl_random_pseudo_bytes(32));
}

if (!isset($_SESSION['csrf'])) {
  $_SESSION['csrf'] = generate_random_token();
}
?>
