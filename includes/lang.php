<? 
////////////////LOCALIZATION
$json = file_get_contents("$domainName/includes/local.json");
//$jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($json, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

$json = preg_replace('/^\xEF\xBB\xBF/', '', $json);
$jsonIterator = json_decode($json, TRUE);
foreach ($jsonIterator as $key => $val) {
    $$key = $val;
}
//////////////


$menuArray = array(
	"home" => "$l_main",
	"video" => "$l_videos",
	"gallery" => "$l_pictures",
	"songs" => "$l_songs",
	"news" => "$l_news",
	"aboutus" => "$l_aboutUs",
	"contactus" => "$l_contactUs"
);

?>