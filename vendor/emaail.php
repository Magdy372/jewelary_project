<?php
require_once('autoload.php');

// Configure API key authorization: api-key
$config = Brevo\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Brevo\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');
// Configure API key authorization: partner-key
$config = Brevo\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', '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');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Brevo\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('partner-key', 'Bearer');

$apiInstance = new Brevo\Client\Api\TransactionalEmailsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sendSmtpEmail = new \Brevo\Client\Model\SendSmtpEmail([
  	 'subject' => 'from the PHP SDK!',
     'sender' => ['name' => 'Sendinblue', 'email' => 'os606030@gmail.com'],
     'replyTo' => ['name' => 'Sendinblue', 'email' => 'os606030@gmail.com'],
     'to' => [[ 'name' => 'Max Mustermann', 'email' => 'os404017@gmail.com']],
     'htmlContent' => '<html><body><h1>This is a transactional email {{params.bodyMessage}}</h1></body></html>',
     'params' => ['bodyMessage' => 'made just for you!']
]); // \Brevo\Client\Model\SendSmtpEmail | Values to send a transactional email

try {
    $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
}
?>