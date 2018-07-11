<?php

namespace WHMCS\Module\Addon\Dns\Client;
use WHMCS\Module\Addon\Dns\Powerdns_class;
use WHMCS\Module\Addon\Dns\Cpaneldns_class;

/**
 * Sample Client Area Controller
 */
class Controller {

    /**
     * Index action.
     *
     * @param array $vars Module configuration parameters
     *
     * @return array
     */
	private $ttl_array; 
	 
	public function __construct() {
		
		$this->set_ttl();
	}
	 
	 
	private function set_ttl() {
		
		$this->ttl_array = ['2592000' => '30 Days',
							'604800' => '7 Days',
							'86400' => '1 Day',
							'43200' => '12 Hours',
							'21600' => '6 Hours',
							'3600' => '1 Hour',
							'1800' => '10 Mins',
							'300' => '5 Mins',
							'60' => '1 Min'];

	}
	 
    public function index($vars) {
		
        // Get common module parameters
		$templatefile = 'publicpage';
		$vars_set = [];
		
		$client_id = $_SESSION['uid'];
		
		$services_query = select_query("tbldomains" , "", ['id' => $vars['id'] , 'userid' => $client_id]);
	 	$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);
		
		$backend = $this->getNSbanckend($services_array['domain']);
		$backend = 'cpanel';
		
		switch($backend) {
			
			case 'nan':
			
				$templatefile = 'nodomains';
				$vars_set = ['outputMsg' => 'NS Lookup Failed.'];
				
			break;

			case 'powerdns':

				$pdns = new Powerdns_class();
				$req = $pdns->request(['cmd' => 'servers/localhost/zones/' . $services_array['domain']] , 'GET');
				
				//Set The Vars
				$templatefile = 'publicpage';
				$vars_set = ['id' => $services_array['id'],
							 'domain' => $services_array['domain'],
							 'domain_replaces' => ['.'.$services_array['domain'].'.' , $services_array['domain'].'.', $services_array['domain']],
							 'ttl_array' => $this->ttl_array,
							 'ttl_array_selected' => 3600,
							 'records' => $req->rrsets];
							 

			break;

			case 'cpanel':

				$cdns = new Cpaneldns_class();
				$req = $cdns->request('dumpzone' , ['domain' => $services_array['domain']]);
				
				$rrsets = [];
				
				if(count($req->result[0]->record) > 0):
					foreach($req->result[0]->record as $key => $value):
						if($value->type !== ':RAW' && $value->type !== '$TTL' && $value->type !== 'SOA' && $value->type !== 'NS'):
						
							$rrsets[] = $value;	
							
						endif;
					endforeach;
				endif;
				
				$templatefile = 'cpaneldomains';
				$vars_set = ['id' => $services_array['id'],
							 'domain' => $services_array['domain'],
							 //'domain_replaces' => ['.'.$services_array['domain'].'.' , $services_array['domain'].'.', $services_array['domain']],
							 'domain_replaces' => $services_array['domain'],
							 'ttl_array' => $this->ttl_array,
							 'ttl_array_selected' => 3600,
							 'records' => $rrsets];
				
			
			break;
			
			default:
			
				$templatefile = 'nodomains';
				$vars_set = ['outputMsg' => 'The domain\'s nameservers aren\'t pointing to HostPresto\'s. If you\'d like HostPresto to manage your DNS then please update your nameservers.'];
				
			break;

			
		}
		
				
        return array(
            'pagetitle' => 'DNS Management',
            'breadcrumb' => array(
			    'clientarea.php' => 'Client Area',
			    'clientarea.php?action=domaindetails' => 'My Domains',
			    'clientarea.php?action=domaindetails&id=' . $services_array['id'] => $services_array['domain'],
                'index.php?m=dns&id=' . $services_array['id'] => 'DNS Management',
            ),
            'templatefile' => $templatefile,
            'requirelogin' => true, // Set true to restrict access to authenticated client users
            'forcessl' => false, // Deprecated as of Version 7.0. Requests will always use SSL if available.
            'vars' => $vars_set,
        );
		
		
		
    }

	public function submit($vars) {
		
		$client_id = $_SESSION['uid'];

		$services_query = select_query("tbldomains" , "", ['id' => $vars['id'], 'userid' => $client_id]);
	 	$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);

		$pdns = new Powerdns_class();
		$request_data = [];
		
		   $request_data = ['rrsets' => [['name' => $_POST['name'],
										  'type' => $_POST['type'],
										  'ttl' => $_POST['ttl'],
										  'changetype' => 'REPLACE',
										  'records' => [['content' => ($_POST['type'] === 'TXT')?'"'.str_replace(array('&quot;','"'),'',$_POST['content']).'"':$_POST['content'],
														 'disabled' => false]]
										  ]]];
		
									  
		$data = json_encode($request_data);							  
									  
		$req = $pdns->request(['cmd' => 'servers/localhost/zones/' . $services_array['domain']] , 'PATCH' , $data);
		
		if($req->error):
			echo json_encode(['code' => 0, 'message' => $req->error, 'data' => []]);
			exit;
		endif;	
		
		echo json_encode(['code' => 1, 'message' => 'Success', 'data' => []]);	
		exit;
		
	}
	
	public function delete($vars) {

		$client_id = $_SESSION['uid'];
		
		$services_query = select_query("tbldomains" , "", ['id' => $vars['id'], 'userid' => $client_id]);
	 	$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);

		$pdns = new Powerdns_class();
		$request_data = [];
		
		$request_data = ['rrsets' => [['name' => $_POST['name'],
									  'type' => $_POST['type'],
									  'ttl' => $_POST['ttl'],
									  'changetype' => 'DELETE',
									  'records' => [['content' => ($_POST['type'] === 'TXT')?'"'.str_replace(array('&quot;','"'),'',$_POST['content']).'"':$_POST['content'],
									  				'disabled' => false]]
									  ]]];
									  
		$data = json_encode($request_data);							  
									  
		$req = $pdns->request(['cmd' => 'servers/localhost/zones/' . $services_array['domain']] , 'PATCH' , $data);
		
		if($req->error):
			echo json_encode(['code' => 0, 'message' => $req->error, 'data' => []]);
			exit;
		endif;	
		
		echo json_encode(['code' => 1, 'message' => 'Success', 'data' => []]);	
		exit;
	}

	public function updatettl($vars) {

		$client_id = $_SESSION['uid'];
		
		$services_query = select_query("tbldomains" , "", ['id' => $vars['id'], 'userid' => $client_id]);
	 	$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);

		$pdns = new Powerdns_class();
		$request_data = [];
		foreach($_POST['data'] as $key => $value):
			
			$request_data['rrsets'][] = ['name' => $value['name'],
										 'type' => $value['type'],
										 'ttl' => $_POST['newttl'],
										 'changetype' => 'REPLACE',
										 'records' => [['content' => ($value['type'] === 'TXT')?'"'.str_replace(array('&quot;','"') , '' , $value['records'][0]['content']).'"':$value['records'][0]['content'],
										 				'disabled' => false]]
										];
		
		endforeach;
											  
		$data = json_encode($request_data);							  
		 
		$req = $pdns->request(['cmd' => 'servers/localhost/zones/' . $services_array['domain']] , 'PATCH' , $data);
		
		if($req->error):
			echo json_encode(['code' => 0, 'message' => $req->error, 'data' => []]);
			exit;
		endif;	
		
		echo json_encode(['code' => 1, 'message' => 'Success', 'data' => []]);	
		exit;
		
	}
	
	public function deleteall($vars) {
		
		$data = json_decode(file_get_contents('php://input'), true);

		$client_id = $_SESSION['uid'];
		
		$services_query = select_query("tbldomains" , "", ['id' => $vars['id'], 'userid' => $client_id]);
	 	$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);

		$pdns = new Powerdns_class();
		$request_data = [];
		foreach($data as $key => $value):
			
			$request_data['rrsets'][] = ['name' => $value['name'],
										 'type' => $value['type'],
										 'ttl' => $value['newttl'],
										 'changetype' => 'DELETE',
										 'records' => [['content' => ($value['type'] === 'TXT')?'"'.str_replace(array('&quot;','"') , '' , $value['records'][0]['content']).'"':$value['records'][0]['content'],
										 				'disabled' => false]]
										];
		
		endforeach;
											  
		$data = json_encode($request_data);							  
		 
		$req = $pdns->request(['cmd' => 'servers/localhost/zones/' . $services_array['domain']] , 'PATCH' , $data);
		
		if($req->error):
			echo json_encode(['code' => 0, 'message' => $req->error, 'data' => []]);
			exit;
		endif;	
		
		echo json_encode(['code' => 1, 'message' => 'Success', 'data' => []]);	
		exit;
		
	}
	
	private function getNSbanckend($domain) {
		
		$backend = 'nan';
		$ns = dns_get_record($domain, DNS_NS);
		//$ns = dns_get_record('dfsdhfsdfjsdjf.de', DNS_NS);

		if(is_array($ns) && sizeof($ns)):
		
			$firstNs = $ns[0]['target'];
			if( stristr( strtolower($firstNs), 'rapidhost.co.uk' )) {
				$backend = 'powerdns';
			} else if( stristr( strtolower($firstNs), 'hpdns.net' )) {
				$backend = 'cpanel';
			} else if( stristr( strtolower($firstNs), 'enixns.com' )) {
				$backend = 'cpanel';
			} else {
				$backend = NULL;  //display message to the user
			}
			
		else:
		
			$backend = 'nan';
										
		endif;

		return $backend;
		
	}
	
}

