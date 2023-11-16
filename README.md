# google-cloud
www.pigmil.com

Before use:
- Set up your Google Cloud
- Create a Service Account
- Generate a API Key in JSON format
- Download the json key file, rename it as '_service_account.json' and replace it at 'lib/_service_account.json'

Installation:
- Download the code files to your computer
- run composer install

Google Vision:

        WebDetect
        Text
        FindLogo
        Landmark
        SafeSearch 

- Example http://localhost/?vision&i=https://imagepath.com/sample.jpg



Google Text-To-Speech (TTS)

- Edit get-voice-list.php, choose the language
- Download the file language, http://localhost/get-voice-list.php
- Generate audio, http://localhost/?tts or http://localhost/index_tts.php
