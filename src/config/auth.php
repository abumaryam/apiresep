<?php 

/**
* 
*/
class auth {
	
	function apiToken($session_uid)
	{
		$key=md5($session_uid);
		return hash('sha256', $key);
	}



}