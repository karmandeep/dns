<div id="update-cpanel-ttl-record-Modal" class="modal record" role="dialog">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2><i class="fa fa-hourglass" aria-hidden="true"></i> Mass TTL Update</h2>
      </div>
      
      <div class="modal-body margin-10">
      
	   <div class="row">
           <div class="col-sm-12 col-md-12 col-lg-12">
    			
                <div class="ttl-update-form">
                <form id="mass-update-cpanel-ttl" onSubmit="return false;" class="mass-update-cpanel-ttl" name="mass-update-cpanel-ttl" method="post" action="index.php?m=dns&id={$id}&action=updatettlcpanel">
                    <input type="hidden" name="id" value="{$id}">
                    <input type="hidden" name="mode" value="editzonerecord">
                    <input type="hidden" name="domain" value="{$domain}"> 

                    <div class="form-group">
                        <label for="inputTtl" class="control-label">Select TTL</label>
                        <select name="newttl" id="inputTtl" class="form-control">
                            {foreach from=$ttl_array key=ttl item=ttltext}
                                  <option value="{$ttl}">{$ttltext}</option>
                            {/foreach}
                        </select>
                    </div>                
                	<input type="hidden" name="data" value="">
                	<div class="form-group text-right">
                        <input type="submit" name="Send" class="btn btn-success" value="Update">
                    </div>
                </form>
                </div>
    
           </div>
       </div>
      
      </div>
      
    </div>
</div>