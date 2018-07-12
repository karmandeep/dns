<div class="row">

	<div class="col-md-3 pull-md-left sidebar">
    	{include file='modules/addons/dns/templates/sidebar.tpl'}
    </div>
    
    
	<div class="col-md-9 pull-md-right">
    	<div class="row">
        	<div class="col-sm-12 col-md-12 col-lg-12 margin-10 ">
       	    	{include file='modules/addons/dns/templates/initials/addcpanel.tpl'}
                {include file='modules/addons/dns/templates/initials/editcpanel.tpl'}
            	<button id="create-record-cpanel" class="btn btn-success margin-10 pull-md-right"><i class="fa fa-plus" aria-hidden="true"></i> Create Record</button> 
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
            
            {if $smarty.get.successmessage}
            	<div class="alert alert-success">
            		{$smarty.get.successmessage}
                </div>
            {/if}
            {if $smarty.get.failedmessage}
            	<div class="alert alert-danger">
            		{$smarty.get.failedmessage}
                </div>
            {/if}
                <div class="panel panel-default">
                
                    <div class="panel-heading">
                        <h3 class="panel-title text-left">
                            Records
                        </h3>
                    </div>
                
                <div>

                    <div class="row">
                        <div class="col-sm-12 text-left">
                           
                            
                            
                                        
                            <table id="example" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th width="30%">Content</th>
                                            <th>TTL</th>
                                            <th width="15%"></th>
                                        </tr>
                                    </thead>
                                     
                                    <tbody>
                                    
                                    
                                    {foreach from=$records item=obj}
                                            <tr data-obj='' >
                                                <td></td>
                                                <td>{$obj->name}</td>
                                                <td>{$obj->type}</td>
                                                <td style="overflow:auto;">
                                                
                                                {if $obj->type eq 'A'}
                                                	{$obj->address}
                                                {elseif $obj->type eq 'CNAME'}
                                                	{$obj->cname}
                                                {elseif $obj->type eq 'MX'}
                                                	{$obj->exchange}
                                                {elseif $obj->type eq 'TXT'}
                                                	{$obj->txtdata|substr:0:25}
                                                {elseif $obj->type eq 'SRV'}
                                                	{$obj->target}
                                                {/if}
                                                
                                                </td>
                                                <td>{$ttl_array[$obj->ttl]}</td>
                                                <td><button class="btn btn-warning btn-edit" onClick="javascript:editcpanel(this);" data-obj='' data-rrsets='' data-name=''><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                &nbsp;<button class="btn btn-danger btn-delete" onClick="javascript:removecpanel('{$domain}' , '{$obj->Line}');"><i class="fa fa-trash" aria-hidden="true"></i> </button</td>
                                            </tr>
                                    {/foreach}        
                                                 
                            
                            
                                    </tbody>
                                </table>   
                                
                        </div>
                    </div>
                
                </div>
                </div>
                {include file='modules/addons/dns/templates/initials/update-editcpanel-ttl.tpl'}
                {include file='modules/addons/dns/templates/initials/delete-editcpanel-ttl.tpl'}
                <div class="dropdown">
                	<button class="btn btn-secondary bulk-actions disabled dropdown-toggle pull-md-left" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bulk Actions <b class="caret"></b></button>
                   	<ul class="dropdown-menu" style="margin-top:25px;" aria-labelledby="dropdownMenuButton">
                    	<li class="dropdown-item"><a onClick="javascript:updatecpanelttl(this);" href="#"><i class="fa fa-hourglass" aria-hidden="true"></i> Adjust TTL</a></li>
                    	<li class="dropdown-item"><a onClick="javascript:deletecpanelAll(this);" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                    </ul>
            	</div>
                
         
                <!--<button onClick="javascript:updatettl(this);" class="btn btn-primary btn-change-tld margin-10 disabled pull-md-right"><i class="fa fa-hourglass" aria-hidden="true"></i> Adjust TTL</button>
                <button onClick="javascript:deleteAll(this);" class="btn btn-danger btn-delete-tld margin-10 disabled pull-md-right"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>-->
            </div>            
        </div>
        	
	</div>    
    
</div>