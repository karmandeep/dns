<div id="edit-record-cpanel-Modal" class="modal record" role="dialog">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Record</h2>
      </div>
      <div class="modal-body margin-10">
      
      <div class="row">
           <div class="col-sm-12 col-md-12 col-lg-12">
    
            <div class="type-selection">
                
                <ul>
                    <li><a rel="A" role="edit-tab">A</a></li>
                    <li><a rel="CNAME" role="edit-tab">CNAME</a></li>
                    <li><a rel="MX"  role="edit-tab">MX</a></li>
                    <li><a rel="TXT" role="edit-tab">TXT</a></li>
                    <li><a rel="SRV" role="edit-tab">SRV</a></li>
                    <li class="visible-lg">&nbsp;</li>
                </ul>
                <div class="tab-content tabs-selection">
                	<div id="edita" rel="A" class="tab-pane" role="edit-tabpanel">
                    	
                        <form id="edit-dns-cpanel-a" class="dns-cpanel-form-edit" name="edit-dnsRecord-cpanel-a" method="post" action="index.php?m=dns&{$idstring}&action=submitcpanel">
                            <input type="hidden" name="mode" value="editzonerecord">
                            <input type="hidden" name="line" value="">
                            {$hidden_id_string}
                            <input type="hidden" name="type" value="A">
                            <input type="hidden" name="domain" value="{$domain}"> 
                   
                            <div class="pull-md-left punchline-text">Use @ to create the record at the root of the domain or enter  a hostname to create it elsewhere. A records are for IPv4 addresses only and tell a request where your domain should direct to.</div>
                    
                    
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="inputName" class="control-label">Hostname</label>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6 pull-md-left">
                                             <input type="text" readonly name="name" id="inputName" value="" class="form-control">
                                            </div>
                                            <div class="col-sm-5 col-md-5 col-lg-5 pull-md-left margin-10">
                                                .{$domain}.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputContent" class="control-label">Will Direct To</label>
                                        <input type="text" name="address"  autocomplete="off" id="inputContent" value="" class="form-control">
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label for="inputTtl" class="control-label">TTL</label>
                                        <select name="ttl" id="inputTtl" class="form-control">
                                            {foreach from=$ttl_array key=ttl item=ttltext}
                                                  <option value="{$ttl}">{$ttltext}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                    
                                    <div class="form-group text-right">
                                        <input type="submit" name="Send" class="btn btn-success" value="Update Record">
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                	<div id="editcname" rel="CNAME" class="tab-pane " role="edit-tabpanel">
                    
                    	<form id="edit-dns-cpanel-cname" class="dns-cpanel-form-edit" name="edit-dnsRecord-cpanel-cname" method="post" action="index.php?m=dns&{$idstring}&action=submitcpanel">
                             <input type="hidden" name="mode" value="editzonerecord">
                             <input type="hidden" name="line" value="">
        					{$hidden_id_string}
                            <input type="hidden" name="type" value="CNAME">
                            <input type="hidden" name="domain" value="{$domain}"> 
                            
                            <div class="pull-md-left punchline-text">CNAME records act as an alias by mapping a hostname to another hostname.</div>
                            
                            <div class="form-group">
                                <label for="inputName" class="control-label">Hostname</label>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6 pull-md-left">
                                     <input type="text" name="name" readonly id="inputName" value="" class="form-control">
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5 pull-md-left margin-10">
                                        .{$domain}.
                                    </div>
                                </div>    
                            </div>
                            
                            <div class="form-group">
                                <label for="inputContent" class="control-label">Is An Alias Of</label>
                                <input type="text" name="cname"  autocomplete="off" id="inputContent" value="" placeholder="Enter hostname" class="form-control">
                            </div>
        
        
                            <div class="form-group">
                                <label for="inputTtl" class="control-label">TTL</label>
                                <select name="ttl" id="inputTtl" class="form-control">
                                    {foreach from=$ttl_array key=ttl item=ttltext}
                                          <option value="{$ttl}">{$ttltext}</option>
                                    {/foreach}
                                </select>
                            </div>
                            
                            
                            <div class="form-group text-right"><!--disabled-->
                                <input type="submit" name="Send" class="btn btn-success" value="Update Record">
                            </div>
                        </form>
                    
                    </div>
                	<div id="editmx" rel="MX" class="tab-pane " role="edit-tabpanel">
                    
                    	<form id="edit-dns-cpanel-mx" class="dns-cpanel-form-edit" name="edit-dnsRecord-cpanel-mx" method="post" action="index.php?m=dns&{$idstring}&action=submitcpanel">
                           <input type="hidden" name="mode" value="editzonerecord">
                           <input type="hidden" name="line" value="">
	       				   {$hidden_id_string}
                           <input type="hidden" name="type" value="MX">
                            <input type="hidden" name="domain" value="{$domain}"> 
                            
                            <div class="pull-md-left punchline-text">MX Records Specify the mail servers responsible for accepting emails on behalf of your domain, and priority value if your provider has a number of mail servers for contingency.</div>
                            
                            <div class="form-group">
                                <label for="inputName" class="control-label">Hostname</label>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6 pull-md-left">
                                     <input type="text" name="name" readonly id="inputName" value="" class="form-control">
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5 pull-md-left margin-10">
                                        .{$domain}.
                                    </div>
                                </div>    
                            </div>
                            
                            <div class="form-group">
                                <label for="inputContent" class="control-label">Mail Provider Mail Server</label>
                                <input type="text" name="exchange"  autocomplete="off" id="inputContent" value="" placeholder="e.g. aspmx.l.google.com" class="form-control">
                            </div>
        
                            <div class="form-group">
                                <label for="inputPriority" class="control-label">Priority</label>
                                 <select name="priority" id="inputPriority" class="form-control">
                                 	{for $foo=0 to 50}
	                                	<option value="{$foo}">{$foo}</option>
                                    {/for}
                                </select>
                            </div>
        
                            <div class="form-group">
                                <label for="inputTtl" class="control-label">TTL</label>
                                <select name="ttl" id="inputTtl" class="form-control">
                                    {foreach from=$ttl_array key=ttl item=ttltext}
                                         <option value="{$ttl}">{$ttltext}</option>
                                    {/foreach}
                                </select>
                            </div>
                            
                            
                            
        
                            <div class="form-group text-right">
                                <input type="submit" name="Send" class="btn btn-success" value="Update Record">
                            </div>
                        </form>
                    	
                    </div>
                	<div id="edittxt" rel="TXT" class="tab-pane " role="edit-tabpanel">
                    
                    	<form id="edit-dns-cpanel-txt" class="dns-cpanel-form-edit" name="edit-dnsRecord-cpanel-txt" method="post" action="index.php?m=dns&{$idstring}&action=submitcpanel">
                           <input type="hidden" name="mode" value="editzonerecord">
                           <input type="hidden" name="line" value="">
	       				   {$hidden_id_string}
                           <input type="hidden" name="type" value="TXT">
                            <input type="hidden" name="domain" value="{$domain}"> 

                            <div class="pull-md-left punchline-text">TXT records are used to associate a string of text with a hostname. These are primarily used for verification.</div>
                            
                            
                            <div class="form-group">
                                <label for="inputName" class="control-label">Hostname</label>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6 pull-md-left">
                                     <input type="text" readonly name="name" id="inputName" value="" class="form-control">
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5 pull-md-left margin-10">
                                        .{$domain}.
                                    </div>
                                </div>    
                            </div>
        
                            <div class="form-group">
                                <label for="inputContent" class="control-label">Value</label>
                                <input type="text" name="txtdata"  autocomplete="off" id="inputContent" value="" placeholder="Paste TXT String here" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="inputTtl" class="control-label">TTL</label>
                                <select name="ttl" id="inputTtl" class="form-control">
                                    {foreach from=$ttl_array key=ttl item=ttltext}
                                          <option value="{$ttl}">{$ttltext}</option>
                                    {/foreach}
                                </select>
                            </div>
                            
                            <div class="form-group text-right">
                                <input type="submit" name="Send" class="btn btn-success" value="Update Record">
                            </div>
                        </form>
                    
                    </div>
                	<div id="editsrv" rel="SRV" class="tab-pane " role="edit-tabpanel">
                    	
                        <form id="edit-dns-cpanel-srv" class="dns-cpanel-form-edit" name="edit-dnsRecord-cpanel-srv" method="post" action="index.php?m=dns&{$idstring}&action=submitcpanel">
                           <input type="hidden" name="mode" value="editzonerecord">
                           <input type="hidden" name="line" value="">
	       				   {$hidden_id_string}
                           <input type="hidden" name="type" value="SRV">
                           <input type="hidden" name="domain" value="{$domain}"> 
                           
                            <div class="pull-md-left punchline-text">SRV records specify the location (hostname and port number) of servers of specific services. You can use service records to direct certain types of traffic to perticular servers.</div>

                            <div class="form-group">
                                <label for="inputName" class="control-label">Hostname</label>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6 pull-md-left">
                                     <input type="text" name="name" readonly id="inputName" value="" placeholder="e.g. _service._protocol" class="form-control">
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5 pull-md-left margin-10">
                                        .{$domain}.
                                    </div>
                                </div>    
                            </div>
                            
                            <div class="form-group">
                                <label for="inputContent" class="control-label">Will Direct To</label>
                                <input type="text" name="target"  autocomplete="off" id="inputContent" value="" placeholder="Enter hostname (e.g. www or domain.com)" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="inputPriority" class="control-label">Priority</label>
                                <select name="priority" id="inputPriority" class="form-control">
                                 	{for $foo=0 to 50}
	                                	<option value="{$foo}">{$foo}</option>
                                    {/for}
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputWeight" class="control-label">Weight</label>
                                <input type="text" name="weight" autocomplete="off" id="inputWeight" value="" placeholder="e.g. 100" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="inputPort" class="control-label">Port</label>
                                <input type="text" name="port"  autocomplete="off" id="inputPort" value="" placeholder="e.g. 5060" class="form-control">
                            </div>
                                    
                            <div class="form-group">
                               	<label for="inputTtl" class="control-label">TTL</label>
                                <select name="ttl" id="inputTtl" class="form-control">
                                    {foreach from=$ttl_array key=ttl item=ttltext}
                                        {if $ttl_array_selected eq $ttl}
                                            <option selected value="{$ttl}">{$ttltext}</option>
                                        {else}
                                            <option value="{$ttl}">{$ttltext}</option>
                                        {/if}
                                    {/foreach}
                                </select>
                            </div>
                            
                            <div class="form-group text-right">
                                <input type="submit" name="Send" class="btn btn-success" value="Update Record">
                            </div>
                        </form>
                        
                        
                    </div>
                </div>
            </div>
           </div>
      </div>
      
      
       
        
        
      </div>
      
    </div>
</div>