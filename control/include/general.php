<?

$url = $_GET['url'];
$url = rtrim($url, '/');
$url = explode('/', $url);
$domainName = 'http://localhost/bek/';
$controlDomainName = 'http://localhost/bek/control/';
$cssFilePath = $controlDomainName . 'include/style.css';
$jqueryFilePath = $controlDomainName . 'include/jquery-library.min.js';
$jsFunctionsFilePath = $controlDomainName . 'include/jsFunctions.js';
$jsLOCALSfilePath = $controlDomainName . "include/jsLocaJson.php";
$ext_all_css = $controlDomainName . "include/ext-all.css";

$homepageGet = 'home';
$setBodyContainerOn = false;
$GetPageVal = $url[0];
$getpage = (isset($GetPageVal) && !empty($GetPageVal) && $GetPageVal !== 'logout' ) ? $url[0] : $homepageGet;
$script_page = return_page_param();

////////////////LOCALIZATION
$json = file_get_contents("$controlDomainName/include/local.json");
$jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($json, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $val) {
    $$key = $val;
}

//////////////
function query($q) {
    if ($res = mysql_query($q)) {
	return $res;
    } else {
		//die('ERROR: ' . mysql_error());
	return false;
    }
}

function check_empty_fields($fields_arr) {
    $empty_fields_arr = array();
    foreach ($fields_arr as $k => $v) {
	if ($v == '') {
	    $empty_fields_arr[] = $k;
	}
    }
    return $empty_fields_arr;
}

function return_page_param() {
    return 'scripts/' . $GLOBALS['getpage'] . '_page.php';
}

function console($log, $type = 'log') {
    $type = ($type && $type !== 'log') ? $type : 'log';
    print "<script>console.$type($log)</script>";
}

function return_globals() {
    //$arr = new Array();
    foreach ($GLOBALS as $k => $v) {
	if ($k !== 'GLOBALS')
	    $arr[$k] = $v;
    }
    return @json_encode($arr);
}

function getCustomerTypeData($cid) {
    $q = "select * from customers_types where cust_type_code = '$cid' ";
    $res = query($q);
    $row = mysql_fetch_row($res);
    return $row;
}

function getMenu() {
    return $GLOBALS['menuArray'];
}

function getPostInput($var) {
    return filter_input(INPUT_POST, $var);
}

function getGetInput($var) {
    return filter_input(INPUT_GET, $var);
}

function getServerInput($var) {
    return filter_input(INPUT_SERVER, $var);
}

$menu_array = array(
    array("$l_home", "home"),
    array("$l_video", array(
	    array($l_categories, "vidCategories"),
	    array($l_videoslist, "vidlist"),
	    array($l_addnewvid, "vid_addnew")
	)
    ),
    array("$l_articles", array(
	    array($l_categories, "articleCategories"),
	    array($l_articleslist, "articles_list"),
	    array($l_addnewarticle, "articles_add")
	)
    ),
    array("$l_images", array(
	    array($l_albums, "gal_cats"),
	    array($l_addnewpic, "gal_addpic"),
	    array($l_picslist, "picslist")
	)
    ),
    array("$l_music", array(
	    array($l_albums, "music_cats"),
	    array($l_addnewsong, "music_addpic"),
	    array($l_musiclist, "musiclist")
	)
    ),
    array("$l_contactus", "contactus"),
    array("$l_aboutus", "aboutus")
);
$menu_icons = array('', 'video.png', 'article.png', 'gallery.png', 'music.png', 'phone.png', 'globe.png', 'wrench_icon.png', 'question.png', 'chat_bubble.png', '', 'health.png');
