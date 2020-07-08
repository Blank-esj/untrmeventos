<?php

require 'autoload.php';

define('URL_SITIO', '//localhost:8080/untrmeventos');

$apiContext = new \PayPal\Rest\ApiContext(
      new \PayPal\Auth\OAuthTokenCredential(
          'AYN1V53bLmzyP-x7pmD9rwwjkggQ3-WWMwR2h0VQZi9QghmVu86NNsOynCCDfw4aCMPqGpJC7Hu1_J_1',  // ClienteID
          'EM1ug-ztIoJZ4JxMOpgDv_Rm0Lhm0tITe68WyliKP0D-5KZXFb4rOSZURlcjC1QbFLVIcwozd5vScqV4'  // Secret
      )
);