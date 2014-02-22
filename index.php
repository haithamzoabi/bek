<?session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);


include("includes/lang.php");
include("includes/general.php");
include("includes/htmlheader.php");
include("includes/connect.php");


$setBodyContainerOn = true;
include("scripts/body.scp.php");	
include("includes/footer.php");
$conn->close();
?>
