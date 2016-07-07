<?php


class VkHelper
{
	function __construct()
	{
		//
	}

	public function req($method, $getArgs = array(), $postArgs = array(), $token = "0000")
	{

		if(strlen($token)>5){
			$getArgs['access_token'] = $token;
		}
		$par = http_build_query($getArgs);
		if(count($postArgs)<1){
			$response = file_get_contents('https://api.vk.com/method/' . $method . '?' . $par);
			return $response;
		}else{
			print_r( $par );
			$curl = curl_init();
			curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => 'https://api.vk.com/method/' . $method . '?' . $par ,
                        CURLOPT_POST => 1,
                        CURLOPT_POSTFIELDS => $postArgs,
                        CURLOPT_SSL_VERIFYPEER => false
                    ));
			$curlR = curl_exec($curl);
			$response = json_decode($curlR);
			return $response;
		}
	}
}