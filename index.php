<?php 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



// (A) Load Composer
require "vendor/autoload.php"; 

  
if(isset($_GET['request'])){
$error = 'Enter the image path following by /?request='.$_GET['request'].'&img=https://example.com/sample.png';

if(!isset($_GET['img'])){ 
    echo $error;
    die;
}

$request = $_GET['request']; 
$path = $_GET['img'];

switch ($request){
    case 'web':  
        require_once('vision_class.php');
        WebDetect($path); 
    break;
    case 'text':  
        require_once('vision_class.php');
        FindText($path); 
    break; 
    case 'logo':  
        require_once('vision_class.php');
        FindLogo($path); 
    break; 
    case 'landmark':  
        require_once('vision_class.php');
        Landmark($path); 
    break;  
    case 'safesearch':  
        require_once('vision_class.php');
        SafeSearch($path); 
    break; 
    case 'face':  
        require_once('vision_class.php');
        FaceDetect($path); 
    break; 
    default:
    echo $error;
}
} else { 
    echo 'Invalid request, enter your request following by http://localhost/?request=google_vision_request_here';
}

?>
