<?
ini_set('display_errors', '0');     # don't show any errors...
error_reporting(E_ALL | E_STRICT);  # ...but do log them

require('parse/autoload.php');
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;

$app_id = "Yqt0rTyLG1zwMbIOQ5B3FtoApz5JR0Ts5nRgnA3P";
$rest_key =  "1UW7AhZH8ZYXG0uZlFeF6pK0vIBvmCGmldkQL9Fj";
$master_key = "56xSGEMuf4Pr2wjyPVetyhwX29LPQGNdEgINXDtA";

ParseClient::initialize( $app_id, $rest_key, $master_key );

$object = new ParseObject("VideoObject");
$object->set('title', $_GET['title']);
$object->set('url', $_GET['url']);

try {
    $object->save();
    $success = true;
} catch(ParseException $e) {
    $success = false;
}

header("Content-type: text/javascript");
$callback = $_GET['callback'];
?>

<?= $callback ?>(<?= $success ? 'true' : 'false' ?>);
