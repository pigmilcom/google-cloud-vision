<?php 

use Google\Cloud\Vision\V1\ImageAnnotatorClient;
global $key_file;
$key_file = __DIR__ . "/lib/_service_account.json";


function WebDetect($img_path){
    try {
        global $key_file;
        $imageAnnotatorClient = new ImageAnnotatorClient(["credentials" => $key_file]); 
        $imageContent = file_get_contents($img_path);
        $response = $imageAnnotatorClient->webDetection($imageContent);
        $web = $response->getWebDetection();
    
        if ($error = $response->getError()) {
            print('API Error: ' . $error->getMessage() . PHP_EOL);
            die;
        }
    
         // Print best guess labels
         printf('%d best guess labels found' . PHP_EOL,
         count($web->getBestGuessLabels()));
        foreach ($web->getBestGuessLabels() as $label) {
            printf('Best guess label: %s' . PHP_EOL, $label->getLabel());
        }
        print(PHP_EOL);
    
        // Print pages with matching images
        printf('%d pages with matching images found' . PHP_EOL,
            count($web->getPagesWithMatchingImages()));
        foreach ($web->getPagesWithMatchingImages() as $page) {
            printf('URL: %s' . PHP_EOL, $page->getUrl());
        }
        print(PHP_EOL);
    
        // Print full matching images
        printf('%d full matching images found' . PHP_EOL,
            count($web->getFullMatchingImages()));
        foreach ($web->getFullMatchingImages() as $fullMatchingImage) {
            printf('URL: %s' . PHP_EOL, $fullMatchingImage->getUrl());
        }
        print(PHP_EOL);
    
        // Print partial matching images
        printf('%d partial matching images found' . PHP_EOL,
            count($web->getPartialMatchingImages()));
        foreach ($web->getPartialMatchingImages() as $partialMatchingImage) {
            printf('URL: %s' . PHP_EOL, $partialMatchingImage->getUrl());
        }
        print(PHP_EOL);
    
        // Print visually similar images
        printf('%d visually similar images found' . PHP_EOL,
            count($web->getVisuallySimilarImages()));
        foreach ($web->getVisuallySimilarImages() as $visuallySimilarImage) {
            printf('URL: %s' . PHP_EOL, $visuallySimilarImage->getUrl());
        }
        print(PHP_EOL);
    
        // Print web entities
        printf('%d web entities found' . PHP_EOL,
            count($web->getWebEntities()));
        foreach ($web->getWebEntities() as $entity) {
            printf('Description: %s, Score %s' . PHP_EOL,
                $entity->getDescription(),
                $entity->getScore());
        }
        
        $imageAnnotatorClient->close();
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}

function FindText($img_path){

    try { 
        global $key_file; 
        $imageAnnotatorClient = new ImageAnnotatorClient(["credentials" => $key_file]); 
        $imageContent = file_get_contents($img_path);
        $response = $imageAnnotatorClient->textDetection($imageContent);
        $text = $response->getTextAnnotations();
    
        if ($error = $response->getError()) {
            print('API Error: ' . $error->getMessage() . PHP_EOL);
            die;
        }
    
        echo $text[0]->getDescription();
        
        $imageAnnotatorClient->close();
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}


function FindLogo($img_path){

    try { 
        global $key_file; 
        $imageAnnotatorClient = new ImageAnnotatorClient(["credentials" => $key_file]); 
        $imageContent = file_get_contents($img_path);
        $response = $imageAnnotatorClient->logoDetection($imageContent);
        $logos = $response->getLogoAnnotations();
    
        printf('%d logos found:' . PHP_EOL, count($logos));
        foreach ($logos as $logo) {
            print($logo->getDescription() . PHP_EOL);
        }
    
        
        $imageAnnotatorClient->close();
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}



function Landmark($img_path){

    try { 
        global $key_file; 
        $imageAnnotatorClient = new ImageAnnotatorClient(["credentials" => $key_file]); 
        $imageContent = file_get_contents($img_path);
        $response = $imageAnnotatorClient->landmarkDetection($imageContent);
        $landmarks = $response->getLandmarkAnnotations();

        printf('%d landmark found:' . PHP_EOL, count($landmarks));
        foreach ($landmarks as $landmark) {
            print($landmark->getDescription() . PHP_EOL);
        }
 
        $imageAnnotatorClient->close();
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}

function SafeSearch($img_path){

    try { 
        global $key_file; 
        $imageAnnotatorClient = new ImageAnnotatorClient(["credentials" => $key_file]); 
        $imageContent = file_get_contents($img_path);
        $response = $imageAnnotatorClient->safeSearchDetection($imageContent);
        $safe = $response->getSafeSearchAnnotation();

        $adult = $safe->getAdult();
        $medical = $safe->getMedical();
        $spoof = $safe->getSpoof();
        $violence = $safe->getViolence();
        $racy = $safe->getRacy();

        # names of likelihood from google.cloud.vision.enums
        $likelihoodName = ['UNKNOWN', 'VERY_UNLIKELY', 'UNLIKELY',
        'POSSIBLE', 'LIKELY', 'VERY_LIKELY'];

        printf('Adult: %s' . PHP_EOL, $likelihoodName[$adult]);
        printf('Medical: %s' . PHP_EOL, $likelihoodName[$medical]);
        printf('Spoof: %s' . PHP_EOL, $likelihoodName[$spoof]);
        printf('Violence: %s' . PHP_EOL, $likelihoodName[$violence]);
        printf('Racy: %s' . PHP_EOL, $likelihoodName[$racy]);
 
        $imageAnnotatorClient->close();
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}


function FaceDetect($img_path){

    try { 
        global $key_file; 
        $imageAnnotatorClient = new ImageAnnotatorClient(["credentials" => $key_file]); 
        $imageContent = file_get_contents($img_path);
        $response = $imageAnnotatorClient->faceDetection($imageContent);
        $faces = $response->getFaceAnnotations();
        // [END vision_face_detection_tutorial_send_request]

        // Output file path
        $outFile = null;
    
        # names of likelihood from google.cloud.vision.enums
        $likelihoodName = ['UNKNOWN', 'VERY_UNLIKELY', 'UNLIKELY',
        'POSSIBLE', 'LIKELY', 'VERY_LIKELY'];
    
        printf('%d faces found:' . PHP_EOL, count($faces));
        foreach ($faces as $face) {
            $anger = $face->getAngerLikelihood();
            printf('Anger: %s' . PHP_EOL, $likelihoodName[$anger]);
    
            $joy = $face->getJoyLikelihood();
            printf('Joy: %s' . PHP_EOL, $likelihoodName[$joy]);
    
            $surprise = $face->getSurpriseLikelihood();
            printf('Surprise: %s' . PHP_EOL, $likelihoodName[$surprise]);
    
            # get bounds
            $vertices = $face->getBoundingPoly()->getVertices();
            $bounds = [];
            foreach ($vertices as $vertex) {
                $bounds[] = sprintf('(%d,%d)', $vertex->getX(), $vertex->getY());
            }
            print('Bounds: ' . join(', ', $bounds) . PHP_EOL);
            print(PHP_EOL);
        }
        // [END vision_face_detection]
    
        # [START vision_face_detection_tutorial_process_response]
        # draw box around faces
        if ($faces->count() && $outFile) {
            $imageCreateFunc = [
                'png' => 'imagecreatefrompng',
                'gd' => 'imagecreatefromgd',
                'gif' => 'imagecreatefromgif',
                'jpg' => 'imagecreatefromjpeg',
                'jpeg' => 'imagecreatefromjpeg',
            ];
            $imageWriteFunc = [
                'png' => 'imagepng',
                'gd' => 'imagegd',
                'gif' => 'imagegif',
                'jpg' => 'imagejpeg',
                'jpeg' => 'imagejpeg',
            ];
    
            copy($img_path, $outFile);
            $ext = strtolower(pathinfo($img_path, PATHINFO_EXTENSION));
            if (!array_key_exists($ext, $imageCreateFunc)) {
                throw new \Exception('Unsupported image extension');
            }
            $outputImage = call_user_func($imageCreateFunc[$ext], $outFile);
    
            foreach ($faces as $face) {
                $vertices = $face->getBoundingPoly()->getVertices();
                if ($vertices) {
                    $x1 = $vertices[0]->getX();
                    $y1 = $vertices[0]->getY();
                    $x2 = $vertices[2]->getX();
                    $y2 = $vertices[2]->getY();
                    imagerectangle($outputImage, $x1, $y1, $x2, $y2, 0x00ff00);
                }
            }
            # [END vision_face_detection_tutorial_process_response]
            # [START vision_face_detection_tutorial_run_application]
            call_user_func($imageWriteFunc[$ext], $outputImage, $outFile);
            printf('Output image written to %s' . PHP_EOL, $outFile);
            # [END vision_face_detection_tutorial_run_application]
        }
        $imageAnnotatorClient->close();
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}