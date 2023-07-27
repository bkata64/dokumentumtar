<? 
include_once('Messages.php');
$msg = new Messages();




// var_dump($_GET);

$getKey = array_keys($_GET);
$urlSegments = array();
$content = '';

if(isset($getKey[0])) {
    $urlSegments = explode('/', $getKey[0]);
}

$object = null;
$className = isset($urlSegments[0]) ? ucfirst($urlSegments[0]) : false;

if($className) {
    include_once("$className.php");
    $object = new $className();

    $method = 'index';

    if(isset($urlSegments[1])) {
       $method = $urlSegments[1];
    }

    if(method_exists($object, $method)) {
        $object->$method();        
        $content = $object->getTemplate() . '.php';
    } else {
        $msg->setErrorMsg("Nem található a $method metódus");
    }
}

?>