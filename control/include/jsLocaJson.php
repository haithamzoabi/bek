<?
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include 'general.php';
echo "var LOCALS = {};";
foreach ($jsonIterator as $key => $val) {
    echo "LOCALS['$key']= '$val';";
}
?>

