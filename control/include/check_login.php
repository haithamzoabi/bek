<?

$POSTlogin = $_POST['login'];
$POSTusername = $_POST['username'];
$POSTpassword = $_POST['password'];
$POSTremember = $_POST['rememberme'];
$page = $_GET['page'];

if ($POSTlogin) {

    if ($POSTusername && $POSTpassword) {

	$query = query("SELECT * FROM users WHERE u_name='$POSTusername' ");
	if (mysql_num_rows($query) != 0) {
	    while ($row = mysql_fetch_assoc($query)) {
		$dbusername = $row['u_name'];
		$dbpassword = $row['u_password'];
	    }

	    if ($POSTusername == $dbusername && $POSTpassword == $dbpassword) {

		if ($POSTremember == "on") {
		    setcookie("username", $dbusername, time() + 3600);
		} else {
		    $_SESSION ['username'] = $dbusername;
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