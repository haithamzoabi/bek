<?php

$dir = $_GET['dir'] . "/";
$dRoot = $_SERVER['DOCUMENT_ROOT'];
$dRootLength = strlen($dRoot);
$dh = opendir($dir);
$files = array();
while (($file = readdir($dh)) !== false) {
    if ($file != '.' AND $file != '..' ) {
        if (filetype($dir . $file) == 'file') {
            $files[] = array(
                'filename' => $file,
                'filesize' => filesize($dir . $file). ' bytes',
                'filedate' => date("F d Y H:i:s", filemtime($dir . $file)),
                'path' => substr($dir . $file,$dRootLength )
            );
        }            
    }
}
closedir($dh);

echo(json_encode(array('documentRoot'=>$dRoot,'files' => $files)));

?>
