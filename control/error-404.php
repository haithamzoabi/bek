<?php

$BN = basename($_SERVER['REDIRECT_URL']);
$map = array(
			'/bek/control/login' => '/bek/control/?page=login',
			'/bek/control/register' => '/bek/control/?page=register',
			);

if (isset($map[$_SERVER['REDIRECT_URL']])) {
    $new_loc = 'http://'.$_SERVER['HTTP_HOST'].$map[$_SERVER['REDIRECT_URL']];
    if (isset($_SERVER['REDIRECT_QUERY_STRING'])) {
        $new_loc .= '?' . 
                    $_SERVER['REDIRECT_QUERY_STRING'];
    }
    header("Location: $new_loc");
} else {
   header("Location:/bek/control/?page=noPage");
}

?>