# google-cloud-vision
Google Cloud Vision


Before use:
- Set up your Google Cloud Account
- Activate Vision API at Google Console
- Create a Service Account
- Generate a API Key in JSON format
- Download the json key file, rename it as '_service_account.json' and replace it at 'lib/_service_account.json'


Installation:
- run, git clone https://github.com/pigmilcom/google-cloud-vision
- Or, download the code files to your computer
- run, composer install

How to use,
Google Vision:

        Web (Find web related content to image)
        Text (Find text in image)
        Logo (Find logos in image)
        Landmark (Find landmarks)
        SafeSearch
        Face

- Example http://localhost/?vision=text&i=https://imagepath.com/sample.jpg

You can find more information and examples at the official documentation website:
https://cloud.google.com/vision/docs/

Official Github Repo:
https://github.com/googleapis/google-cloud-php-vision
