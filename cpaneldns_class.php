<?php

namespace WHMCS\Module\Addon\Dns;

	class Cpaneldns_class {
		
		public $cpaneldns_server_url;
		public $cpaneldns_api_user;
		public $cpaneldns_api_token;
		
		public function __construct() {

			$vars = [];
			$addons_query = select_query("tbladdonmodules" , 'setting , value' , ['module' => 'dns']);
			while($addons_array = mysql_fetch_array($addons_query , MYSQL_ASSOC)) {
				$vars[$addons_array['setting']] = $addons_array['value'];
			}
			
			$this->cpaneldns_server_url = $vars['cpaneldnsServerUrl'];
			$this->cpaneldns_api_user = $vars['cpaneldnsApiUser'];
			$this->cpaneldns_api_token = $vars['cpaneldnsApiToken'];
			
		}
		
		
		public function request($cmd = 'applist', $params = [] , $type = 'POST') {
			
			$query_string = $this->cpaneldns_server_url . ':2087/json-api/' . $cmd . '?' .  http_build_query($params);
		 
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
		 
			$header[0] = "Authorization: whm $this->cpaneldns_api_user:$this->cpaneldns_api_token";
			
			curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
			
			curl_setopt($curl, CURLOPT_URL, $query_string);
		 
			$result = curl_exec($curl);
		 
			$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			
			if ($http_status != 200) {
				echo "[!] Error: " . $http_status . " returned\n";
				exit;
			} else {
				$json = json_decode($result);
			}
		 
			curl_close($curl);
    		
			return $json;

		}
		
	}

?>