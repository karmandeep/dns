<div id="delete-ttl-record-Modal" class="modal record" role="dialog">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2><i class="fa fa-trash" aria-hidden="true"></i> Delete Selected</h2>
      </div>
      
      <div class="modal-body margin-10">
      
	   <div class="row">
           <div class="col-sm-12 col-md-12 col-lg-12">
    		 <div class="ttl-update-form">
               <form id="mass-delete-ttl" onSubmit="return false;" class="mass-delete-ttl" name="mass-delete-ttl" method="post" action="index.php?m=dns&id={$id}&action=massdelete">
                    <input type="hidden" name="id" value="{$id}">
                    <input type="hidden" name="mode" value="updatettl">
                    <input type="hidden" name="domain" value="{$domain}"> 

                        <div class="mass-delete-items">
                        	
                        </div>            
                	<input type="hidden" name="data" value="">
                	<div class="form-group text-right">
                        <button class="btn btn-success">No</button>
                        <input type="submit" name="Send" class="btn btn-danger" value="Yes">
                    </div>
                </form>
             </div>
           </div>
       </div>
      
      </div>
      
    </div>
</div>