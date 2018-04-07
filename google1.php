<?php
require_once '/libs/google-api-php-client/vendor/autoload.php'; 
function getUserFromToken($token) {
  $client = new Google_Client();
  $ticket = $client->verifyIdToken($token);
  if ($ticket) {
   // $data = $ticket->getAttributes();
    return $ticket['sub']; // user ID
    //return $data['payload']['sub']; // user ID
	//return "ага";
  }
	  return false;
}

//$ticket = $client->verifyIdToken($_POST['idtoken']);
echo getUserFromToken($_POST['idtoken']);
?>