<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WHMCS - PowerDNS - Records</title>

    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    <link href="templates/blend/css/all.min.css?v=adcb9b" rel="stylesheet" />

	
    <script type="text/javascript">
    

	
	
    	function checkForm(Form) {
			
			if(Form.content.value == '') {
				alert("Please Enter Record Content.");
				Form.content.focus();
				return false;
			} else if(Form.ttl.value == '') {
				alert("Please Enter Record TTL.");
				Form.ttl.focus();
				return false;
			} else {
				return true;
			}
			
			
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
       
    <form name="createRecord" onSubmit="return checkForm(this);" action="addonmodules.php?module=dns&<?php echo $dString; ?>&action=submit" method="post">
    	<input type="hidden" name="mode" value="add">
    
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
                <tr>
                    <td class="fieldlabel text-left" ></td>
                    <td class="fieldlabel text-left" >Type:</td>
                    <td class="fieldarea text-left" >

                       <select name="type">
                        	<?php foreach( $this->type_array as $key => $value ): ?>
                            	<?php if($_GET['type'] === $key): ?>
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
                    <td class="fieldarea text-left" ><input type="text" name="content" value="<?php echo $_GET['content']; ?>" ></td>
                    <td class="fieldlabel text-left" ></td>
                </tr>
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