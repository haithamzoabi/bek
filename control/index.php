<?session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
date_default_timezone_set('Asia/Jerusalem');

include("include/lang.php");
include("include/general.php");
include("include/htmlheader.php");
include("include/connect.php");
include("include/check_login.php");


$loggedInFun = loggedin();
if (!$loggedInFun || $loggedInFun == false) {
    include("include/login.php");
} else {
    $setBodyContainerOn = true;
    include("scripts/pageheader.php");
    include($script_page);
}

include("include/footer.php");
$conn->close();
?>