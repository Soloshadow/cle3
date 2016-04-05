<?php
session_start();

require_once 'fb/src/Facebook/autoload.php';
require_once 'fb/src/Facebook/FacebookResponse.php';

$fb = new Facebook\Facebook(['app_id' => '469174096627150',
    'app_secret' => '440a4cddd24ecf5cc7d6b8e708be3fb6',
    'default_graph_version' => 'v2.5',
'default_access_token' => isset ($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : '469174096627150|440a4cddd24ecf5cc7d6b8e708be3fb6'
]);



$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    //echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    //echo 'Facebook SDK returned an error: ' . $e->getMessage();
}

if (isset($accessToken)) {
    // Logged in!
    $_SESSION['facebook_access_token'] = (string) $accessToken;
} elseif ($helper->getError()) {
    // The user denied the request
}
header('Location: index.php');