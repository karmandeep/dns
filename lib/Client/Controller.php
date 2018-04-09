<?php

namespace WHMCS\Module\Addon\Dns\Client;
use WHMCS\Module\Addon\Dns\Powerdns_class;

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
	 
	 
    public function index($vars)
    {
        // Get common module parameters
		
		$services_query = select_query("tblhosting" , "", ['id' => $vars['id']]);
	 	$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);

		$pdns = new Powerdns_class();
		
		$req = $pdns->request(['cmd' => 'servers/localhost/zones/' . $services_array['domain']] , 'GET');
		
		$ttl_array = ['2592000' => '30 Days',
					  '604800' => '7 Days',
					  '86400' => '1 Day',
					  '43200' => '12 Hours',
					  '21600' => '6 Hours',
					  '3600' => '1 Hour',
					  '1800' => '10 Mins',
					  '300' => '5 Mins',
					  '60' => '1 Min'];
				
        return array(
            'pagetitle' => 'DNS Management',
            'breadcrumb' => array(
			    'clientarea.php' => 'Client Area',
			    'clientarea.php?action=productdetails' => 'My Products &amp; Services',
			    'clientarea.php?action=productdetails&id=' . $services_array['id'] => 'Product Details',
                'index.php?m=dns&id=' . $services_array['id'] => 'DNS Management',
            ),
            'templatefile' => 'publicpage',
            'requirelogin' => true, // Set true to restrict access to authenticated client users
            'forcessl' => false, // Deprecated as of Version 7.0. Requests will always use SSL if available.
            'vars' => array(
                'id' => $services_array['id'],
                'domain' => $services_array['domain'],
                'domain_replaces' => '.'.$services_array['domain'].'.',
				'ttl_array' => $ttl_array,
				'ttl_array_selected' => 3600,
				'records' => $req->rrsets
            ),
        );
    }

	public function submit($vars) {
		

		$services_query = select_query("tblhosting" , "", ['id' => $vars['id']]);
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
		
		$services_query = select_query("tblhosting" , "", ['id' => $vars['id']]);
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
		
		$services_query = select_query("tblhosting" , "", ['id' => $vars['id']]);
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
		
		$services_query = select_query("tblhosting" , "", ['id' => $vars['id']]);
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
	
}

