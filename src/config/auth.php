<?php 

/**
* 
*/
class auth {
	
	function apiToken($session_uid)
	{
		$key=md5(SITE_KEY.$session_uid);
		return hash('sha256', $key);
	}



}