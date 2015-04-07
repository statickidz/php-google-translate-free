header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');  
header('Content-Type: application/json');
require_once('GoogleTranslate.php');
$translator = new GoogleTranslate($_GET['source'],$_GET['target']);
$translation = $translator->translate($_GET['q']);
$response = new stdClass();
if($translation != '') {
	$response->status = true;
    $response->translation = $translation;
} else {
    $response->status = false;
}
echo json_encode($response);
