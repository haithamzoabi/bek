<?

$url = $_GET['url'];
$url = rtrim($url, '/');
$url = explode('/', $url);
$domainName = 'http://localhost/bek/';
$controlDomainName = 'http://localhost/bek/control/';
$cssFilePath = $controlDomainName . 'include/style.css';
$jqueryFilePath = $controlDomainName . 'include/jquery-library.min.js';
$jsFunctionsFilePath = $controlDomainName . 'include/jsFunctions.js';

$homepageGet = 'home';
$setBodyContainerOn = false;
$GetPageVal = $url[0];
$getpage = (isset($GetPageVal) && !empty($GetPageVal) && $GetPageVal !== 'logout' ) ? $url[0] : $homepageGet;
$script_page = return_page_param();

function query($q) {
    if ($res = mysql_query($q)) {
	return $res;
    } else {
	die('ERROR: ' . mysql_error());
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

$menuArray = array(
    "home" => "$l_main",
    "video" => "$l_videos",
    "gallery" => "$l_pictures",
    "songs" => "$l_songs",
    "news" => "$l_news",
    "aboutus" => "$l_aboutUs",
    "contactus" => "$l_contactUs"
);

function getMenu() {
    return $GLOBALS['menuArray'];
}

$menu_array = array(
    array("$l_home", "home"),
    array("$l_aboutus", "aboutus"),
    array("$l_articles", array(array($l_articleslist, "articles_list"), array($l_addnewarticle, "articles_add"))),
    array("$l_gallery", array(array($l_cats, "gal_cats"), array($l_addnewpic, "gal_addpic&sid=" . $_GET['sid']), array($l_picslist, "picslist&sid=" . $_GET['sid']))),
    array("$l_video", array(array($l_videoslist, "vidlist"), array($l_addnewvid, "vid_addnew"))),
    array("$l_contactus", "contactus"),
    array("$l_latest_news", array(array($l_newlist, 'news_list'), array($l_addnewreport, 'news_addnew'))),
    array("$l_ourservices", "ourservices"),
    array("$l_qa", array(array($l_questionslist, 'questions_list'), array($l_addnewquestion, "questions_addnew"))),
    array("$l_dynamictext", "text_add"),
    array("$l_termsofuse", "termsofuse"),
    array("$l_patientsSystem", array(array($l_patientsList, 'patientsList'), array($l_addNewPatient, 'addNewPatient'))),
);
$menu_icons = array('', 'info.png', 'article.png', 'gallery.png', 'video.png', 'phone.png', 'globe.png', 'wrench_icon.png', 'question.png', 'chat_bubble.png', '', 'health.png');