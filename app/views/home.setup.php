<?php

if (defined('HOSTNAME') && strtolower($_SERVER['HTTP_HOST']) != HOSTNAME) {
  $path = '';
  if (wispr_pong() == 'show-intro') {
    $path = 'intro';
  }
  $hostname = HOSTNAME;
  header("Location: http://$hostname/$path");
  exit;
}

$ssl_enabled = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ||
                $_SERVER['SERVER_PORT'] == 443);

$grid->response->redirect('/forum');
exit;

?>
