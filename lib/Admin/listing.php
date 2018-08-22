<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WHMCS - PowerDNS - Records</title>

    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    <link href="templates/blend/css/all.min.css?v=adcb9b" rel="stylesheet" />


    <script type="text/javascript">
    	function remove(name , type , content , ttl) {
			var txt;
			var r = confirm("Confirm Delete!");
			if (r == true) {
				
				//Lets Delete
				window.location = "addonmodules.php?module=dns&<?php echo $dString; ?>&action=delete&name="+encodeURI(name)+"&type="+type+"&content="+encodeURI(content)+"&ttl="+ttl+"";
				
			} else {
				
			}    
		}
		
		<?php
			if(isset($_GET['result']) && $_GET['result'] === 'success'):
		?> 
			setTimeout( function() {
						window.location = "addonmodules.php?module=dns&<?php echo $dString; ?>";
					}
					 , 5000);
		<?php	
			endif;
		?>
    </script>
    
    </head>
    <body data-phone-cc-input="1">
    <div class="row">
    	<div class="col-md-12 pull-md-right text-right" style="margin:15px;">
      		<label onClick="window.open('addonmodules.php?module=dns&<?php echo $dString; ?>&action=add','addwindow','width=800,height=300,top=100,left=100,scrollbars=yes')" class="btn btn-success"><i class="fa fa-plus"></i> Create Record</label>  
      	</div>
    </div>    
    <div class="row">
    	<div class="col-md-12" style="margin:15px;">
        
	 <table class="form" style="font-size:10px;" width="100%" border="0" cellspacing="0" cellpadding="0">
     
      			<?php
					if(isset($_GET['result']) && $_GET['result'] === 'error'):
				?>   
                	<tbody>	
                        <tr>
                            <td class="text-center alert-danger" colspan="5"><?php echo $_GET['msg']; ?></td>
                        </tr>
                    </tbody>	
               
                <?php	
					endif;
				?>
       			<?php
					if(isset($_GET['result']) && $_GET['result'] === 'success'):
				?> 
                	<tbody>	
                        <tr>
                            <td class="text-center alert-success" colspan="5">Deleted Sucessfuly</td>
                        </tr>
                    </tbody>	
                
                <?php	
					endif;
				?>
    
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
            	<?php if($value->type !== 'NS' && $value->type !== 'SOA'): ?>
                <tbody>	
                    <tr>
                        <!--<td class="text-left" width="20%"></td>-->
                        <td class="fieldarea text-left" width="35%"><?php echo $value->name; ?></td>
                        <td class="fieldarea text-left" width="10%"><?php echo $value->type; ?></td>
                        <td class="fieldarea text-left" width="30%"><?php echo str_replace(array('&quot;','"'),'',$subValue->content); ?></td>
                        <td class="fieldarea text-left" width="10%"><?php echo $this->ttl_array[$value->ttl]; ?></td>
                        <td class="fieldarea text-center"><label onClick="window.open('addonmodules.php?module=dns&<?php echo $dString; ?>&action=edit&name=<?php echo $value->name; ?>&type=<?php echo $value->type; ?>&ttl=<?php echo $value->ttl; ?>&content=<?php echo urlencode($subValue->content); ?>','editwindow','width=800,height=300,top=100,left=100,scrollbars=yes')" class="btn btn-warning"><i class="fa fa-pencil"></i></label> <label onClick="remove('<?php echo $value->name; ?>' , '<?php echo $value->type; ?>' , '<?php echo urlencode($subValue->content); ?>' , '<?php echo $value->ttl; ?>')" class="btn btn-danger"><i class="fa fa-trash"></i></label> </td>
                    </tr>
                </tbody>
                <?php endif; ?>
	        <?php endforeach; ?>
        <?php endforeach; ?>
	</table>
    	</div>    	
    </div>
    <div class="row">
    	<div class="col-md-12 pull-md-right text-center" style="margin:15px;">
        	<button onClick="window.close();" class="btn btn-default">Close</button>
    	</div>
    </div>
	</body>
    </html>