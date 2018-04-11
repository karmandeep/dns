<?php

namespace WHMCS\Module\Addon\Dns\Admin;
use WHMCS\Module\Addon\Dns\Powerdns_class;

/**
 * Sample Admin Area Controller
 */
class Controller {

    /**
     * Index action.
     *
     * @param array $vars Module configuration parameters
     *
     * @return string
     */
	 private $type_array = [];
	 private $ttl_array = [];
	 
	 /**
     * Show action.
     *
     * @param array $vars Module configuration parameters
     *
     * @return string
     */
	 public function __construct() {
		 
	   $this->setTypeArray();
	   $this->set_ttl();
	   	 
	 }
	 
	 /**
	 * Set type array
	 *
	 **/
	 private function setTypeArray() {
		 
		 
	   $this->type_array = ['A' => 'A',
	   						'A6' => 'A6',
							'AAAA' => 'AAAA',
							'AFSDB' => 'AFSDB',
							'ALIAS' => 'ALIAS',
							'CAA' => 'CAA',
							'CDNSKEY' => 'CDNSKEY',
							'CDS' => 'CDS',
							'CERT' => 'CERT',
							'CNAME' => 'CNAME',
							'DHCID' => 'DHCID',
							'DLV' => 'DLV',
							'DNSKEY' => 'DNSKEY',
							'DNAME' => 'DNAME',
							'DS' => 'DS',
							'EUI48' => 'EUI48',
							'EUI64' => 'EUI64',
							'HINFO' => 'HINFO',
							'IPSECKEY' => 'IPSECKEY',
							'KEY' => 'KEY',
							'KX' => 'KX',
							'LOC' => 'LOC',
							'MAILA' => 'MAILA',
							'MAILB' => 'MAILB',
							'MINFO' => 'MINFO',
							'MR' => 'MR',
							'MX' => 'MX',
							'NAPTR' => 'NAPTR',
							//'NS' => 'NS',
							'NSEC' => 'NSEC',
							'NSEC3' => 'NSEC3',
							'NSEC3PARAM' => 'NSEC3PARAM',
							'OPENPGPKEY' => 'OPENPGPKEY',
							'OPT' => 'OPT',
							'PTR' => 'PTR',
							'RKEY' => 'RKEY',
							'RP' => 'RP',
							'RRSIG' => 'RRSIG',
							'SIG' => 'SIG',
							//'SOA' => 'SOA',
							'SPF' => 'SPF',
							'SRV' => 'SRV',
							'SSHFP' => 'SSHFP',
							'TLSA' => 'TLSA',
							'TKEY' => 'TKEY',
							'TSIG' => 'TSIG',
							'TXT' => 'TXT',
							'WKS' => 'WKS',
							'URI' => 'URI'];
		 

	 }


	 /**
	 * Set type array
	 *
	 **/
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
	 
	 /**
     * Show action.
     *
     * @param array $vars Module configuration parameters
     *
     * @return string
     */
    public function index($vars) {
		
		if(isset($_GET['service_id']) && $_GET['service_id'] != NULL):
		
			$service_id = $_GET['service_id'];
			// Get common module parameters
	
			$services_query = select_query("tbldomains" , "", ['id' => $service_id]);
			$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);
	
			$backend = $this->getNSbanckend($services_array['domain']);
			//$backend = 'powerdns';
			
			switch($backend) {
					
					case 'nan':
						
						die('<h3>NS Lookup Failed.</h3>');
						
					break;
		
					case 'powerdns':
		
						$pdns = new Powerdns_class();
						$req = $pdns->request(['cmd' => 'servers/localhost/zones/' . $services_array['domain']] , 'GET');
								
					break;
		
					case 'cpanel':
		
						die('<h3>DNS Settings Unavailable At The Moment.</h3>');
									
					break;
					
					default:
					   
					   die('<h3>No Records Found.</h3>');
					   
					break;
				
			}
			
			include('listing.php');
			exit;
    
		endif; //END IF
    }

 	/**
     * Show action.
     *
     * @param array $vars Module configuration parameters
     *
     * @return string
     */
	public function add($vars) {
		
		if(isset($_GET['service_id']) && $_GET['service_id'] != NULL):
		
			$service_id = $_GET['service_id'];
			
			$services_query = select_query("tbldomains" , "", ['id' => $service_id]);
			$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);
			 
			include('add.php');
			exit;
				
		endif; //END IF
	}
	
	
	
    /**
     * Show action.
     *
     * @param array $vars Module configuration parameters
     *
     * @return string
     */
	public function edit($vars) {
		
		if(isset($_GET['service_id']) && $_GET['service_id'] != NULL):
		
			$service_id = $_GET['service_id'];
		
			$services_query = select_query("tbldomains" , "", ['id' => $service_id]);
			$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);
		
			$name_array = [];
			if(($services_array['domain'].'.') === $_GET['name']) {
				$name_array[0] = '';
			} else {
				$name_array = explode('.', $_GET['name']);
			}
			
			if($_GET['type'] === 'TXT') {
				$content = str_replace(array('&quot;','"'),'',$_GET['content']);
			} else {
				$content = $_GET['content'];
			}
			
		    include('edit.php');
			exit;
			
		endif; //END IF
	}
	
    /**
     * Show action.
     *
     * @param array $vars Module configuration parameters
     *
     * @return string
     */
    public function submit($vars) {
		
		
		
		if(isset($_GET['service_id']) && $_GET['service_id'] != NULL):
			$service_id = $_GET['service_id'];
			
			$services_query = select_query("tbldomains" , "", ['id' => $service_id]);
			$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);

	
			$pdns = new Powerdns_class();
			$request_data = [];
			
			   $request_data = ['rrsets' => [['name' => ($_POST['name']?$_POST['name'].'.'.$services_array['domain'].'.':$services_array['domain'].'.'),
											  'type' => $_POST['type'],
											  'ttl' => $_POST['ttl'],
											  'changetype' => 'REPLACE',
										      'records' => [['content' => ($_POST['type'] === 'TXT')?'"'.str_replace(array('&quot;','"'),'',$_POST['content']).'"':$_POST['content'],
															 'disabled' => false]]
											  ]]];
			
										  
			$data = json_encode($request_data);							  
										  
			$req = $pdns->request(['cmd' => 'servers/localhost/zones/' . $services_array['domain']] , 'PATCH' , $data);



			if($req->error):
				header("Location: addonmodules.php?module=dns&service_id=" . $service_id . "&action=".$_POST['mode']."&result=error&msg=" . urlencode($req->error)."&name=".$_POST['name']."&type=".$_POST['type']."&content=".urlencode($_POST['content'])."&ttl=".$_POST['ttl']);
				exit;
			endif;	
			
			header("Location: addonmodules.php?module=dns&service_id=" . $service_id . "&action=".$_POST['mode']."&result=success"."&name=".$_POST['name']."&type=".$_POST['type']."&content=".urlencode($_POST['content'])."&ttl=".$_POST['ttl']);
			exit;

		endif;	
		
	}
	
     /**
     * Show action.
     *
     * @param array $vars Module configuration parameters
     *
     * @return string
     */
	 public function delete($vars) {
		 
		if(isset($_GET['service_id']) && $_GET['service_id'] != NULL):
			$service_id = $_GET['service_id'];
			
			$services_query = select_query("tbldomains" , "", ['id' => $service_id]);
			$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);

	
			$pdns = new Powerdns_class();
			$request_data = [];
			
			   $request_data = ['rrsets' => [['name' => $_GET['name'],
											  'type' => $_GET['type'],
											  'ttl' => $_GET['ttl'],
											  'changetype' => 'DELETE',
										      'records' => [['content' => ($_GET['type'] === 'TXT')?'"'.str_replace(array('&quot;','"'),'',$_GET['content']).'"':$_GET['content'],
															 'disabled' => false]]
											  ]]];
			
										  
			$data = json_encode($request_data);							  
										  
			$req = $pdns->request(['cmd' => 'servers/localhost/zones/' . $services_array['domain']] , 'PATCH' , $data);



			if($req->error):
				header("Location: addonmodules.php?module=dns&service_id=" . $service_id . "&result=error&msg=" . urlencode($req->error));
				exit;
			endif;	
			
			header("Location: addonmodules.php?module=dns&service_id=" . $service_id . "&result=success");
			exit;

		endif;	
		 
	 }
	 
	 
	
    /**
     * Show action.
     *
     * @param array $vars Module configuration parameters
     *
     * @return string
     */
	private function getNSbanckend($domain) {
		
		$backend = 'nan';
		$ns = dns_get_record($domain, DNS_NS);
		//$ns = dns_get_record('dfsdhfsdfjsdjf.de', DNS_NS);

		if(is_array($ns) && sizeof($ns)):
		
			$firstNs = $ns[0]['target'];
			if( stristr( $firstNs, 'rapidhost.co.uk' )) {
				$backend = 'powerdns';
			} else if( stristr( $firstNs, 'hpdns.net' )) {
				$backend = 'cpanel';
			} else if( stristr( $firstNs, 'enixns.com' )) {
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
