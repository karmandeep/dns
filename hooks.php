<?php
/**
 * WHMCS SDK Sample Addon Module Hooks File
 *
 * Hooks allow you to tie into events that occur within the WHMCS application.
 *
 * This allows you to execute your own code in addition to, or sometimes even
 * instead of that which WHMCS executes by default.
 *
 * @see https://developers.whmcs.com/hooks/
 *
 * @copyright Copyright (c) WHMCS Limited 2017
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */

// Require any libraries needed for the module to function.
// require_once __DIR__ . '/path/to/library/loader.php';
//
// Also, perform any initialization required by the service's library.

/**
 * Register a hook with WHMCS.
 *
 * This sample demonstrates triggering a service call when a change is made to
 * a client profile within WHMCS.
 *
 * For more information, please refer to https://developers.whmcs.com/hooks/
 *
 * add_hook(string $hookPointName, int $priority, string|array|Closure $function)
 */
add_hook('ClientEdit', 1, function(array $params) {
    try {
        // Call the service's function, using the values provided by WHMCS in
        // `$params`.
    } catch (Exception $e) {
        // Consider logging or reporting the error.
    }
});


add_hook('ClientAreaPrimarySidebar', 1, function($menu) {	

	 if(isset($_GET['id'])):
	 
		 $hosting_id = $_GET['id'];
		 
			 if (!is_null($menu->getChild('Domain Details Management'))) {
				// Add a link to the module filter.
				$menu->getChild('Domain Details Management')
					->addChild(
						'DNS Management',
						array(
							'uri' => 'index.php?m=dns&id='.$hosting_id,
							'order' => 15,
						)
					);
			}
			
	endif; //END Isset ID
});
 



add_hook('ClientAreaHeadOutput', 1, function($vars) {
	
		
	if(basename($vars['templatefile']) === 'publicpage.tpl'):
	
		return '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/sl-1.2.5/datatables.min.css"/>
				<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
				<link rel="stylesheet" href="'.$vars['systemsslurl'].'modules/addons/dns/templates/css/dns.css" />
				';
	
	endif;		
});


add_hook('ClientAreaFooterOutput', 1, function($vars) {
			
	if(basename($vars['templatefile']) === 'publicpage.tpl'):
			
		return '<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/sl-1.2.5/datatables.min.js"></script>
				<script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
				<script type="text/javascript" src="'.$vars['systemsslurl'].'modules/addons/dns/templates/js/dns.js"></script>';
			
	endif;

});



add_hook('AdminClientDomainsTabFields', 1, function($vars) {
    // Perform hook code here...
	//This is basically Service ID
	$service_id = $vars['id'];
						echo '<div class="margin-10 text-right pull-md-left"><label style="margin:10px;" onClick="window.open(\'addonmodules.php?module=dns&service_id='.$service_id.'\',\'movewindow\',\'width=800,height=600,top=100,left=100,scrollbars=yes\')" class="btn btn-default"><i class="fa fa-globe"></i> DNS Settings</label></div>';

	//echo '<table class="form" width="100%" border="0" cellspacing="0" cellpadding="0">';
	//	echo '<tbody>';
	//		echo '<tr>';
	//			echo '<td class="fieldlabel" width="100%">';
	//				echo '<label onClick="window.open(\'addonmodules.php?module=dns&service_id='.$service_id.'\',\'movewindow\',\'width=800,height=600,top=100,left=100,scrollbars=yes\')" class="btn btn-default"><i class="fa fa-globe"></i> DNS Settings</label>';
	//			echo '</td>';
	//		echo '</tr>';
	//	echo '</tbody>';
	//echo '</table>';
	//return '12345';
});