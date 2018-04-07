<?php
require_once '/libs/google-api-php-client/vendor/autoload.php ' ; 
//$client = new Google_Client();
//$ticket = $client->verifyIdToken($token);
?>
<html lang="en">
  <head>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="846998585230-oct4e70i9en6bivrhaak2ikremk4ga8q.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
	
	
  </head>
  <body>
    <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
    <script>
      function onSignIn(googleUser) {
		  
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());
        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'http://finansist3261.com/google1.php');
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
		  console.log('Signed in as: ' + xhr.responseText);
		};
		xhr.send('idtoken=' + id_token);
      };

		  function signOut() {
			var auth2 = gapi.auth2.getAuthInstance();
			auth2.signOut().then(function () {
			  console.log('User signed out.');
			});
			}
		 
</script>
    </script>
  </body>
   <a href="#" onclick="signIn();">Sign in</a>
   <a href="#" onclick="signOut();">Sign out</a>
   <form method="post">
<input type="hidden" name="token" value="" />
</form>
</html>
