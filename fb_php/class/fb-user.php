<?php
session_start();

require_once '';

$fb = new Facebook\Facebook(['app_id' => '469174096627150',
    'app_secret' => '440a4cddd24ecf5cc7d6b8e708be3fb6',
    'default_graph_version' => 'v2.5',
    'default_access_token' => isset ($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : '469174096627150|440a4cddd24ecf5cc7d6b8e708be3fb6'
]);

try {
    $response = $fb->get('/me?fields=id,name');
    $user = $response->getGraphUser();
    echo 'Name: ' . $user['name'];
    exit; //redirect, or do whatever you want
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    //echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    //echo 'Facebook SDK returned an error: ' . $e->getMessage();
}

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes'];
$loginUrl = $helper->getLoginUrl('http://localhost:63342/cle3/login-callback.php', $permissions);
echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';