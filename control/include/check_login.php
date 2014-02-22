<?

$POSTlogin = $_POST['login'];
$POSTusername = $_POST['username'];
$POSTpassword = $_POST['password'];
$POSTremember = $_POST['rememberme'];
$page = $GetPageVal;
$err_msg = false;

if (isset($POSTlogin)) {

    if ($POSTusername && $POSTpassword) {

	$res = query("SELECT * FROM users WHERE u_name='$POSTusername' ");
	if ($res->num_rows != 0) {
	    while ($row = $res->fetch_assoc()) {
		$dbusername = $row['u_name'];
		$dbpassword = $row['u_password'];
	    }

	    if ($POSTusername == $dbusername && $POSTpassword == $dbpassword) {
		$_SESSION ['username'] = $dbusername;
		if ($POSTremember == "on") {
		    setcookie("username", $dbusername, time() + 3600);
		}
	    } else {
		$err_msg = $l_badpassword;
	    }
	} else {
	    $err_msg = $l_usernamenotexist;
	}
    } else {
	$err_msg = $l_correct_usernameandpasswrod;
    }
}

$username = (isset($_SESSION['username'])) ? $_SESSION['username'] : $_COOKIE['username'];

if ($page === 'logout') {
    $_SESSION['username'] = false;
    $_COOKIE['username'] = false;
    session_destroy();
    setcookie("username", "", time() - 7200);
    unset($username);
}

function loggedin() {
    $session = isset($_SESSION['username']) && !empty($_SESSION['username']);
    $cookie = isset($_COOKIE['username']) && !empty($_COOKIE['username']);
    return ( $session || $cookie ) ? true : false;
}

?>