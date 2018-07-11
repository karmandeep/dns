<?php

namespace WHMCS\Module\Addon\Dns;

	class Powerdns_class {
		
		public $powerdns_server_url;
		public $powerdns_api_key;
		
		public function __construct() {

			$vars = [];
			$addons_query = select_query("tbladdonmodules" , 'setting , value' , ['module' => 'dns']);
			while($addons_array = mysql_fetch_array($addons_query , MYSQL_ASSOC)) {
				$vars[$addons_array['setting']] = $addons_array['value'];
			}
			
			$this->powerdns_server_url = $vars['powerdnsServerUrl'];
			$this->powerdns_api_key = $vars['powerdnsApiKey'];
			
		}
		
		
		public function request($params = [] , $type, $data = []) {
			
				$ch = curl_init();
				//echo $this->powerdns_api_key;
				//echo $this->powerdns_server_url.':8081/api/v1/'.$params['cmd'];
				curl_setopt($ch, CURLOPT_URL, $this->powerdns_server_url.':8081/api/v1/'.$params['cmd']);
				//http://ns1.yourserver.com/api/?key=Your-API-Key
				
				//curl_setopt($ch, CURLOPT_POST,false);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type); 
				//curl_setopt($ch, CURLOPT_USERPWD, "X-API-Key:" . $this->powerdns_api_key);
				//if($type === 'PATCH'):
				
				//	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				//		'User-Agent: Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31',
				//		'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
				//		'X-API-Key: ' . $this->powerdns_api_key,
				//		'Content-Type: application/json'
				//	));
				
				//else:*/
				
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'User-Agent: Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31',
						'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
						'X-API-Key: ' . $this->powerdns_api_key
					));
					
				//endif;
				
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       
				$info = curl_getinfo($ch);
				//echo '<pre>';
				//print_r($info);
				$data = curl_exec($ch);
				//				print_r($data);
				//exit;
				curl_close($ch);
				//return $data;
				
				
				return json_decode($data);

		}
		
	}

?>