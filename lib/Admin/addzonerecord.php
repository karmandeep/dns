<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WHMCS - cPanelDNS - Records</title>

    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    <link href="templates/blend/css/all.min.css?v=adcb9b" rel="stylesheet" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>    
	
    <script type="text/javascript">

		$(function(){
			
			 $('#fields-container').html(showDynamicContent($('#createRecord').find('select[name="type"] option:selected').val()));
			
			 $('#createRecord').find('select[name="type"]').change(function(e){
				 
				$('#fields-container').html(showDynamicContent($("option:selected", this).val()));
				//Count The TR
				
			 });
			
		});
    
	
	
		function showDynamicContent(type) {
			
			var content = '';
		
			content += '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
			
			switch(type) {
				
					case 'A':
						
							content += '<tr>';
						  		
								content += '<td class="fieldlabel text-left" ></td>';
								content += '<td class="fieldlabel text-left" >Address:</td>';
								content += '<td class="fieldarea text-left" ><input type="text" name="address" value="" ></td>';
								content += '<td class="fieldlabel text-left" ></td>';
						
							content += '</tr>';

						//$('#field-title').html('Address:');
						//$('#field-input').html('<input type="text" name="address" value="<?php echo $_GET['address']; ?>" >');
					
					break;
					
					case 'CNAME':

							content += '<tr>';
						  		
								content += '<td class="fieldlabel text-left" ></td>';
								content += '<td class="fieldlabel text-left" >CNAME:</td>';
								content += '<td class="fieldarea text-left" ><input type="text" name="cname" value="" ></td>';
								content += '<td class="fieldlabel text-left" ></td>';
						
							content += '</tr>';


					break;
					
					case 'MX':

							content += '<tr>';
						  		
								content += '<td class="fieldlabel text-left" ></td>';
								content += '<td class="fieldlabel text-left" >Priority:</td>';
								content += '<td class="fieldarea text-left" ><input type="text" name="priority" value="" ></td>';
								content += '<td class="fieldlabel text-left" ></td>';
						
							content += '</tr>';

							content += '<tr>';
						  		
								content += '<td class="fieldlabel text-left" ></td>';
								content += '<td class="fieldlabel text-left" >Exchange:</td>';
								content += '<td class="fieldarea text-left" ><input type="text" name="exchange" value="" ></td>';
								content += '<td class="fieldlabel text-left" ></td>';
						
							content += '</tr>';

					break;

					case 'TXT':

							content += '<tr>';
						  		
								content += '<td class="fieldlabel text-left" ></td>';
								content += '<td class="fieldlabel text-left" >Text Data:</td>';
								content += '<td class="fieldarea text-left" ><input type="text" name="txtdata" value="" ></td>';
								content += '<td class="fieldlabel text-left" ></td>';
						
							content += '</tr>';

					break;

					case 'SRV':


							content += '<tr>';
						  		
								content += '<td class="fieldlabel text-left" ></td>';
								content += '<td class="fieldlabel text-left" >Priority:</td>';
								content += '<td class="fieldarea text-left" ><input type="text" name="priority" value="" ></td>';
								content += '<td class="fieldlabel text-left" ></td>';
						
							content += '</tr>';

							content += '<tr>';
						  		
								content += '<td class="fieldlabel text-left" ></td>';
								content += '<td class="fieldlabel text-left" >Weight:</td>';
								content += '<td class="fieldarea text-left" ><input type="text" name="weight" value="" ></td>';
								content += '<td class="fieldlabel text-left" ></td>';
						
							content += '</tr>';

							content += '<tr>';
						  		
								content += '<td class="fieldlabel text-left" ></td>';
								content += '<td class="fieldlabel text-left" >Port:</td>';
								content += '<td class="fieldarea text-left" ><input type="text" name="port" value="" ></td>';
								content += '<td class="fieldlabel text-left" ></td>';
						
							content += '</tr>';

							content += '<tr>';
						  		
								content += '<td class="fieldlabel text-left" ></td>';
								content += '<td class="fieldlabel text-left" >Target:</td>';
								content += '<td class="fieldarea text-left" ><input type="text" name="target" value="" ></td>';
								content += '<td class="fieldlabel text-left" ></td>';
						
							content += '</tr>';


					break;
					
				}
		
				content += '</table>';
		
				
				return content;
		}
	
    	function checkForm(Form) {
			
			return true;
		}
    
    </script>

    <?php
		if(isset($_GET['result']) && $_GET['result'] === 'success'):
	?>
    	<script type="text/javascript">	
			alert('Record Added Successfully.'); 
			window.opener.location.reload(false);
			window.close();
			
		</script>
    <?php	
		endif;
	?>
    
    </head>
    <body data-phone-cc-input="1">
       
    <div class="row">
    	<div class="col-md-12" style="margin:15px;">
       
    <form id="createRecord" name="createRecord" onSubmit="return checkForm(this);" action="addonmodules.php?module=dns&<?php echo $dString; ?>&action=submitcpanel" method="post">
    	<input type="hidden" name="mode" value="addzonerecord">
    
        <table class="form" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
            	<tr>
                    <td class=" text-left" colspan="4"> <h1>Add Recod</h1> </td>
                </tr>	
                
                <?php
					if(isset($_GET['result']) && $_GET['result'] === 'error'):
				?>
                    <tr>
                    	<td></td>
                        <td class="text-center alert-danger" colspan="2"><?php echo $_GET['msg']; ?></td>
                        <td></td>
                    </tr>                
                <?php	
					endif;
				?>
                
                <tr>
                    <td class="fieldlabel text-left" width="10%" ></td>
                    <td class="fieldlabel text-left" width="20%" >Name:</td>
                    <td class="fieldarea text-left" width="65%" ><input type="text" name="name" value="<?php echo $_GET['name']; ?>" > .<?php echo $services_array['domain']; ?></td>
                    <td class="fieldlabel text-left" width="15%" ></td>
                </tr>
                <tr >
                    <td class="fieldlabel text-left" ></td>
                    <td class="fieldlabel text-left" >Type:</td>
                    <td class="fieldarea text-left" >

                       <select name="type">
                       		<option <?php if($_GET['type'] === 'A'): ?> selected <?php endif; ?> value="A">A</option>
                       		<option <?php if($_GET['type'] === 'CNAME'): ?> selected <?php endif; ?> value="CNAME">CNAME</option>
                       		<option <?php if($_GET['type'] === 'MX'): ?> selected <?php endif; ?> value="MX">MX</option>
                       		<option <?php if($_GET['type'] === 'TXT'): ?> selected <?php endif; ?> value="TXT">TXT</option>
                       		<option <?php if($_GET['type'] === 'SRV'): ?> selected <?php endif; ?> value="SRV">SRV</option>
                        </select>                    
                    
                    </td>
                    <td class="fieldlabel text-left" ></td>
                </tr>
                
                <tr>
                	<td colspan="4" id="fields-container"></td>
                </tr>
                
                <!--
                <tr>
                    <td class="fieldlabel text-left" ></td>
                    <td class="fieldlabel text-left" id="field-title" ></td>
                    <td class="fieldarea text-left" id="field-input" ></td>
                    <td class="fieldlabel text-left" ></td>
                </tr>
                -->
                
                <tr>
                    <td class="fieldlabel text-left" ></td>
                    <td class="fieldlabel text-left" >TTL:</td>
                    <td class="fieldarea text-left" >
                    
                    <select name="ttl">
						<?php foreach( $this->ttl_array as $key => $value ): ?>
                            <?php if($_GET['ttl'] == $key): ?>
                                <option selected value="<?php echo $key; ?>"><?php echo $value; ?></option>                                
                        <?php else: ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>                                
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>  
                    <td class="fieldlabel text-left" ></td>
                </tr>
                
                <tr>
                    <td class="text-center" colspan="4"><input class="btn btn-default" type="button" name="cancel" onClick="window.close();" value="Cancel">&nbsp;<input class="btn btn-primary" type="submit" name="submit" value="Add"></td>
                </tr>
                
            </tbody>
        </table>    	
    
    </form>
     	</div>
    </div>
    </body>
    </html>