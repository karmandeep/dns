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
    public function index($vars)
    {
		if(isset($_GET['service_id']) && $_GET['service_id'] != NULL):
		$service_id = $_GET['service_id'];
        // Get common module parameters

		$services_query = select_query("tbldomains" , "", ['id' => $service_id,'type' => 'Register']);
	 	$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);

		$pdns = new Powerdns_class();
		
		$req = $pdns->request(['cmd' => 'servers/localhost/zones/' . $services_array['domain']] , 'GET');
	
		
?>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WHMCS - PowerDNS - Records</title>

    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    <link href="templates/blend/css/all.min.css?v=adcb9b" rel="stylesheet" />
    <script type="text/javascript" src="templates/blend/js/scripts.min.js?v=adcb9b"></script>

    
    <script type="text/javascript" src="../assets/js/AdminClientDropdown.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-tabdrop.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/tabdrop.css" />
    <script type="text/javascript" src="/assets/js/bootstrap-tabdrop.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/tabdrop.css" />
    
    </head>
    <body data-phone-cc-input="1">
    <div class="row">
    	<div class="col-md-12 pull-md-right text-right" style="margin:15px;">
      		<label onClick="window.open('addonmodules.php?module=dns&service_id=<?php echo $service_id; ?>&action=createnew','newrecwindow','width=800,height=300,top=100,left=100,scrollbars=yes')" class="btn btn-success"><i class="fa fa-plus"></i> Create New</label>  
      	</div>
    </div>    
    <div class="row">
    	<div class="col-md-12" style="margin:15px;">
        
	 <table class="form" style="font-size:10px;" width="100%" border="0" cellspacing="0" cellpadding="0">
 		<thead>
            <tr>
                <!--<th></th>-->
                <th>Name</th>
                <th>Type</th>
                <th>Content</th>
                <th>TTL</th>
                <th></th>
            </tr>
        </thead>
        
        <?php foreach($req->rrsets as $key => $value): ?>
        	<?php foreach($value->records as $subKey => $subValue): ?>
                <tbody>	
                    <tr>
                        <!--<td class="text-left" width="20%"></td>-->
                        <td class="fieldarea text-left" width="35%"><?php echo $value->name; ?></td>
                        <td class="fieldarea text-left" width="10%"><?php echo $value->type; ?></td>
                        <td class="fieldarea text-left" width="30%"><?php echo $subValue->content; ?></td>
                        <td class="fieldarea text-left" width="10%"><?php echo $value->ttl; ?></td>
                        <td class="fieldarea text-center"><label onClick="window.open('addonmodules.php?module=dns&service_id=<?php echo $service_id; ?>&action=edit&name=<?php echo $value->name; ?>&type=<?php echo $value->type; ?>&content=<?php echo urlencode($subValue->content); ?>&ttl=<?php echo $value->ttl; ?>','editwindow','width=800,height=300,top=100,left=100,scrollbars=yes')" class="btn btn-warning"><i class="fa fa-pencil"></i></label> <label class="btn btn-danger"><i class="fa fa-trash"></i></label> </td>
                    </tr>
                </tbody>
	        <?php endforeach; ?>
        <?php endforeach; ?>
	</table>
    	</div>    	
    </div>
	</body>
    </html>
<?php
    
		exit;
		endif; //END IF
    }


	public function createnew($vars) {
		
		if(isset($_GET['service_id']) && $_GET['service_id'] != NULL):
		 $service_id = $_GET['service_id'];

		 $type_array = ['A6' => 'A6',
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
						'NS' => 'NS',
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
						'SOA' => 'SOA',
						'SPF' => 'SPF',
						'SRV' => 'SRV',
						'SSHFP' => 'SSHFP',
						'TLSA' => 'TLSA',
						'TKEY' => 'TKEY',
						'TSIG' => 'TSIG',
						'TXT' => 'TXT',
						'WKS' => 'WKS',
						'URI' => 'URI'];
		

	
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WHMCS - PowerDNS - Records</title>

    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    <link href="templates/blend/css/all.min.css?v=adcb9b" rel="stylesheet" />
    <script type="text/javascript" src="templates/blend/js/scripts.min.js?v=adcb9b"></script>

    
    <script type="text/javascript" src="../assets/js/AdminClientDropdown.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-tabdrop.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/tabdrop.css" />
    <script type="text/javascript" src="/assets/js/bootstrap-tabdrop.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/tabdrop.css" />
    
    </head>
    <body data-phone-cc-input="1">
       
    <div class="row">
    	<div class="col-md-12" style="margin:15px;">
       
    <?php
	
		if($_GET['msg'] === 'success'):
		
	?>
    	<script type="text/javascript">	
			window.opener.location.reload(false);
			window.close();
		</script>
    <?php	
		endif;
	
	?>
    <form name="createRecord" action="addonmodules.php?module=dns&service_id=<?php echo $service_id; ?>&action=create" method="post">
    	<input type="hidden" name="mode" value="createnew">
        <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
    
        <table class="form" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
            	<tr>
                    <td class=" text-left" colspan="4"> <h1>Create New Recod</h1> </td>
                </tr>	
                <?php
	
					if($_GET['msg'] === 'error'):
					
				?>
                <tr>
                    <td class=" text-left" colspan="4"> Invalid Values, Please try again. </td>
                </tr>
                
                <?php	
					endif;
				
				?>
                
                <tr>
                    <td class="fieldlabel text-left" width="10%" ></td>
                    <td class="fieldlabel text-left" width="20%" >Name:</td>
                    <td class="fieldarea text-left" width="65%" ><input type="text" name="name" value="" ></td>
                    <td class="fieldlabel text-left" width="15%" ></td>
                </tr>
                <tr>
                    <td class="fieldlabel text-left" ></td>
                    <td class="fieldlabel text-left" >Type:</td>
                    <td class="fieldarea text-left" >

                       <select name="type">
                        	<?php foreach( $type_array as $key => $value ): ?>
								<option value="<?php echo $key; ?>"><?php echo $value; ?></option>                                
                            <?php endforeach; ?>
                        </select>                    
                    
                    </td>
                    <td class="fieldlabel text-left" ></td>
                </tr>
                <tr>
                    <td class="fieldlabel text-left" ></td>
                    <td class="fieldlabel text-left" >Content:</td>
                    <td class="fieldarea text-left" ><input type="text" name="content" value="" ></td>
                    <td class="fieldlabel text-left" ></td>
                </tr>
                <tr>
                    <td class="fieldlabel text-left" ></td>
                    <td class="fieldlabel text-left" >TTL:</td>
                    <td class="fieldarea text-left" ><input type="text" name="ttl" value="" ></td>
                    <td class="fieldlabel text-left" ></td>
                </tr>
                <tr>
                    
                    <td class="text-right" colspan="4"><input class="btn btn-default" type="submit" name="submit" value="Create"></td>
                </tr>
            </tbody>
        </table>    	
    
    </form>
     	</div>
    </div>
    </body>
    </html>
	
	
	
<?php		
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
    public function create($vars) {
		
		if(isset($_GET['service_id']) && $_GET['service_id'] != NULL):
			$service_id = $_GET['service_id'];
			
			$services_query = select_query("tbldomains" , "", ['id' => $service_id,'type' => 'Register']);
			$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);
	
			$pdns = new Powerdns_class();
			$request_data = [];
			
			   $request_data = ['rrsets' => [['name' => $_POST['name'],
											  'type' => $_POST['type'],
											  'ttl' => $_POST['ttl'],
											  'changetype' => 'REPLACE',
											  'records' => [['content' => $_POST['content'],
															 'disabled' => false]]
											  ]]];
			
										  
			$data = json_encode($request_data);							  
										  
			$req = $pdns->request(['cmd' => 'servers/localhost/zones/' . $services_array['domain']] , 'PATCH' , $data);


			if($req->error):
				header("Location: addonmodules.php?module=dns&service_id=" . $service_id . "&action=createnew&msg=error");
				exit;
			endif;	
			
			header("Location: addonmodules.php?module=dns&service_id=" . $service_id . "&action=createnew&msg=success");
			exit;

		endif;	
		
		
		
		
	}
	
	
	public function edit($vars) {
		
		if(isset($_GET['service_id']) && $_GET['service_id'] != NULL):
		$service_id = $_GET['service_id'];
		
		
		 $type_array = ['A6' => 'A6',
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
						'NS' => 'NS',
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
						'SOA' => 'SOA',
						'SPF' => 'SPF',
						'SRV' => 'SRV',
						'SSHFP' => 'SSHFP',
						'TLSA' => 'TLSA',
						'TKEY' => 'TKEY',
						'TSIG' => 'TSIG',
						'TXT' => 'TXT',
						'WKS' => 'WKS',
						'URI' => 'URI'];
		
		
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WHMCS - PowerDNS - Records</title>

    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    <link href="templates/blend/css/all.min.css?v=adcb9b" rel="stylesheet" />
    <script type="text/javascript" src="templates/blend/js/scripts.min.js?v=adcb9b"></script>

    
    <script type="text/javascript" src="../assets/js/AdminClientDropdown.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-tabdrop.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/tabdrop.css" />
    <script type="text/javascript" src="/assets/js/bootstrap-tabdrop.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/tabdrop.css" />
    
    </head>
    <body data-phone-cc-input="1">
       
    <div class="row">
    	<div class="col-md-12" style="margin:15px;">
       
    <?php
	
		if($_GET['msg'] === 'success'):
		
	?>
    	<script type="text/javascript">	
			window.opener.location.reload(false);
			window.close();
		</script>
    <?php	
		endif;
	
	?>
    <form name="createRecord" action="addonmodules.php?module=dns&service_id=<?php echo $service_id; ?>&action=update" method="post">
    	<input type="hidden" name="mode" value="createnew">
        <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
    
        <table class="form" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
            	<tr>
                    <td class=" text-left" colspan="4"> <h1>Edit Recod</h1> </td>
                </tr>	
                <?php
	
					if($_GET['msg'] === 'error'):
					
				?>
                <tr>
                    <td class=" text-left" colspan="4"> Invalid Values, Please try again. </td>
                </tr>
                
                <?php	
					endif;
				
				?>
                
                <tr>
                    <td class="fieldlabel text-left" width="10%" ></td>
                    <td class="fieldlabel text-left" width="20%" >Name:</td>
                    <td class="fieldarea text-left" width="65%" ><input type="text" name="name" value="<?php echo $_GET['name']; ?>" ></td>
                    <td class="fieldlabel text-left" width="15%" ></td>
                </tr>
                <tr>
                    <td class="fieldlabel text-left" ></td>
                    <td class="fieldlabel text-left" >Type:</td>
                    <td class="fieldarea text-left" >

                        <select name="type">
                        	<?php foreach( $type_array as $key => $value ): ?>
                            	<?php if($_GET['type'] === $value): ?>
									<option selected value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php else: ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>                                
                                <?php endif; ?>                         
                            <?php endforeach; ?>
                        </select>                    
                    
                    </td>
                    <td class="fieldlabel text-left" ></td>
                </tr>
                <tr>
                    <td class="fieldlabel text-left" ></td>
                    <td class="fieldlabel text-left" >Content:</td>
                    <td class="fieldarea text-left" ><input type="text" name="content" value="<?php echo htmlspecialchars_decode($_GET['content']); ?>" ></td>
                    <td class="fieldlabel text-left" ></td>
                </tr>
                <tr>
                    <td class="fieldlabel text-left" ></td>
                    <td class="fieldlabel text-left" >TTL:</td>
                    <td class="fieldarea text-left" ><input type="text" name="ttl" value="<?php echo $_GET['ttl']; ?>" ></td>
                    <td class="fieldlabel text-left" ></td>
                </tr>
                <tr>
                    
                    <td class="text-right" colspan="4"><input class="btn btn-default" type="submit" name="submit" value="Update"></td>
                </tr>
            </tbody>
        </table>    	
    
    </form>
     	</div>
    </div>
    </body>
    </html>
	
	
	
<?php		
		exit;
		endif; //END IF
	}
	
	
	public function update($vars) {
		
		if(isset($_GET['service_id']) && $_GET['service_id'] != NULL):
			$service_id = $_GET['service_id'];
			
			$services_query = select_query("tbldomains" , "", ['id' => $service_id,'type' => 'Register']);
			$services_array = mysql_fetch_array($services_query , MYSQL_ASSOC);
	
			$pdns = new Powerdns_class();
			$request_data = [];
			
			   $request_data = ['rrsets' => [['name' => $_POST['name'],
											  'type' => $_POST['type'],
											  'ttl' => $_POST['ttl'],
											  'changetype' => 'REPLACE',
											  'records' => [['content' => $_POST['content'],
															 'disabled' => false]]
											  ]]];
//			echo '<pre>';
//			print_r($request_data);
										  
			$data = json_encode($request_data);							  
										  
			$req = $pdns->request(['cmd' => 'servers/localhost/zones/' . $services_array['domain']] , 'PATCH' , $data);

			if($req->error):
				
				header("Location: addonmodules.php?module=dns&service_id=" . $service_id . "&action=edit&msg=error&name=".$_POST['name'].'&type='.$_POST['type'].'&ttl='.$_POST['ttl'].'&content='.urlencode($_POST['content']));
				exit;
			endif;	
			
			header("Location: addonmodules.php?module=dns&service_id=" . $service_id . "&action=edit&msg=success");
			exit;

		endif;			
		exit;
	}
	
}
