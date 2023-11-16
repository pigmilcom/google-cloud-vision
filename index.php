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
$img_path = $_GET['img'];

switch ($request){
    case 'web':  
        require_once('vision_class.php');
        WebDetect($img_path); 
    break;
    case 'text':  
        require_once('vision_class.php');
        FindText($img_path); 
    break; 
    case 'logo':  
        require_once('vision_class.php');
        FindLogo($img_path); 
    break; 
    case 'landmark':  
        require_once('vision_class.php');
        Landmark($img_path); 
    break;  
    case 'safesearch':  
        require_once('vision_class.php');
        SafeSearch($img_path); 
    break; 
    case 'face':  
        require_once('vision_class.php');
        FaceDetect($img_path); 
    break; 
    default:
    echo $error;
}
} else { 
    echo 'Invalid request, enter your request following by http://localhost/?request=google_vision_request_here';
}

?>
