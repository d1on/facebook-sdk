<?php

	// The API key of your Kontagent application. This can be found by logging into
	// the Kontagent Dashboard. Note that this is NOT the same as your Facebook AppId.
	define("KT_API_KEY", "");

	// Whether to send the tracking messages to Kontagent's Test Servers. If this is set to
	// true, data will not be processed to your dashboard. Use this for debugging purposes.
	define("KT_USE_TEST_SERVER", true);

	// Whether to send tracking messages on the client-side. If false, messages will be
	// sent server-side. Note that certain messages can only be sent from the client-side (PGR)
	// and some messages can only be sent server-side (INR) - these messages are not affected
	// by this flag.
	define("KT_SEND_CLIENT_SIDE", false);

	// Whether to send client-side tracking messages through HTTPS. This can be set to either
	// true, false, or "auto". If "auto", the library will detect the protocol the current user is using.
	// IMPORTANT: We DO NOT recommend setting this to true as sending messages through HTTPS is 
	// very resource intensive and may cause performance issues.
	define("KT_USE_HTTPS", "auto");

	// This is the http url to the 'kontagent_redirect.php' file provided to you as part of the Kontagent Facebook SDK
	// E.g: htpp://www.website.com/kontagent/kontagent_redirect.php
	define("KT_REDIRECT_URL", "");
    
	// Your Facebook APP ID, provided to you by Facebook
	define("FB_APP_ID", "");

	// Your Facebook APP Secret, provided to you by Facebook
	define("FB_SECRET", "");

	// This is the absolute path to the facebook.php file provided to you by Facebook in their SDK
	// E.g: /home/user/public_html/facebook-php-sdk/src/facebook.php
	define("FB_SDK_PATH", "");

	// This is the base path of your application.
	// If an ad click or stream post redirect fails, users will be redirected to this page instead
	// E.g: http://apps.facebook.com/yourapp
	define("FB_APP_URL","");
?>
