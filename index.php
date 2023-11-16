<?php 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



// (A) Load Composer
require "vendor/autoload.php"; 

  
if(isset($_GET['tts'])){
     include_once('index_tts.php');
}

elseif(isset($_GET['vision'])){

if(!isset($_GET['i'])){ 
    echo 'Enter the image path following by /?vision='.$_GET['vision'].'&i=https://example.com/sample.png';
    die;
}

$request = $_GET['vision']; 
$url = $_GET['i'];

switch ($request){
    case 'web':  
        require_once('vision_class.php');
        WebDetect($url); 
    break;
    case 'text':  
        require_once('vision_class.php');
        FindText($url); 
    break; 
    case 'logo':  
        require_once('vision_class.php');
        FindLogo($url); 
    break; 
    case 'landmark':  
        require_once('vision_class.php');
        Landmark($url); 
    break;  
    case 'safesearch':  
        require_once('vision_class.php');
        SafeSearch($url); 
    break; 
    case 'face':  
        require_once('vision_class.php');
        FaceDetect($url); 
    break; 
    default:
    echo 'Invalid request.';
}
} else {

    echo 'Load request options.';
}

?>