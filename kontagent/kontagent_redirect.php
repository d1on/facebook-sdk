<?php

require_once "kontagent_config.php";
require_once FB_SDK_PATH;
require_once "./kontagent_facebook.php";

$ktFacebook= new KontagentFacebook(array(
	'appId' => FB_APP_ID,
	'secret' => FB_SECRET
));

$userId = $ktFacebook->getUser();

if (isset($_GET['kt_track_ucc']) && isset($_GET['kt_type'])) {
	$shortUniqueTrackingTag = $ktFacebook->getKontagentApi()->genShortUniqueTrackingTag();

	$ktFacebook->getKontagentApi()->trackThirdPartyCommClick($_GET['kt_type'], array(
		'shortUniqueTrackingTag' => $shortUniqueTrackingTag,
		'userId' => $userId,
		'subtype1' => isset($_GET['kt_st1']) ? $_GET['kt_st1'] : null,
		'subtype2' => isset($_GET['kt_st2']) ? $_GET['kt_st2'] : null,
		'subtype3' => isset($_GET['kt_st3']) ? $_GET['kt_st3'] : null
	));

    $target_url = isset($_GET['kt_redir_url']) ? $_GET['kt_redir_url'] : FB_APP_URL;

	// append vars so that landing page tracks the install
	$redirUrl = appendVarsToUrl($target_url, array(
		'kt_track_apa' => 1,
		'kt_su' => $shortUniqueTrackingTag
	));

	redirect($redirUrl);
} else if (isset($_GET['kt_track_psr'])  && isset($_GET['kt_u'])) {
	$ktFacebook->getKontagentApi()->trackStreamPostResponse($_GET['kt_u'], 'stream', array(
		'userId' => $userId,
		'subtype1' => isset($_GET['kt_st1']) ? $_GET['kt_st1'] : null,
		'subtype2' => isset($_GET['kt_st2']) ? $_GET['kt_st2'] : null,
		'subtype3' => isset($_GET['kt_st3']) ? $_GET['kt_st3'] : null
	));

    $target_url = isset($_GET['kt_redir_url']) ? $_GET['kt_redir_url'] : FB_APP_URL;

	// append vars so that the landing page tracks the install
	$redirUrl = appendVarsToUrl($target_url, array(
		'kt_track_apa' => 1,
		'kt_u' => $_GET['kt_u']
	));

	redirect($redirUrl);
} else if (isset($_GET['kt_set_session'])) {
    // Don't redirect here, this is only ever accessed by an image tag
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION['kt_installed'] = true;
} else {
	// Fall back to the app's homepage if the url is somehow malformed
	redirect(FB_APP_URL);
}

////////////////////////////////////////////////////////////////////////////////

function redirect($url) 
{
	header("location:" . $url);
	exit();
}

function appendVarsToUrl($url, $vars = array()) 
{
	if (strstr($url, '?') === false) {
		$url .= '?';
	} else {
		$url .= '&';
	}

	foreach($vars as $key => $val) {
		if (isset($val)) {
			$url .= $key . '=' . $val . '&';
		}
	}

	// remove trailing ampersand
	return removeTrailingAmpersand($url);
}

function removeTrailingAmpersand($string)
{
	if (substr($string, -1) == '&') {
		return substr($string, 0, -1);
	} else {
		return $string;
	}
}

?>