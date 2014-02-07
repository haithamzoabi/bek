<?php

$BN = basename($_SERVER['REDIRECT_URL']);
$map = array(
			'/bek/login' => '/bek/?page=login',
			'/bek/register' => '/bek/?page=register',
			);

if (isset($map[$_SERVER['REDIRECT_URL']])) {
    $new_loc = 'http://'.$_SERVER['HTTP_HOST'].$map[$_SERVER['REDIRECT_URL']];
    if (isset($_SERVER['REDIRECT_QUERY_STRING'])) {
        $new_loc .= '?' . 
                    $_SERVER['REDIRECT_QUERY_STRING'];
    }
    header("Location: $new_loc");
} else {
   header("Location:/bek/?page=noPage");
}

?>