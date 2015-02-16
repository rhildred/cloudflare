<?php

class CloudFlare{
	public static function toggleDevelopmentMode($sDomain, $bOn) {
		$oCreds = json_decode(file_get_contents(__DIR__ . "/../../../creds/cloudflare.json"));
		$fields = array("tkn"=>$oCreds->api_key, "email"=>$oCreds->email, "a"=>"devmode", "z"=>$sDomain, "v"=>$bOn?1:0);
        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, "https://www.cloudflare.com/api_json.html");
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //execute post
        $oResult = json_decode(curl_exec($ch));
        //close connection
        curl_close($ch);
		return($oResult);

	}

}
