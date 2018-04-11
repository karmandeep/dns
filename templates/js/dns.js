

/*

Custom File file for Pluggin.

*/

function edit(element) {
	
			var obj = JSON.parse($(element).attr('data-obj')); 
			var rrsets = JSON.parse($(element).attr('data-rrsets')); 
			var dname = $(element).attr('data-name'); 
			
			$('#edit-record-Modal .type-selection ul li').each(function(index, elem) {
				$(elem).removeClass('active');
				$(elem).removeClass('disabled');
				
				$(elem).parent().next().children()	.each(function(i,e){
					$(e).removeClass('active');
					if($(e).attr('rel') == obj.type) {
						$(e).addClass('active');
					}
				})
				
				if($(elem).find('a').attr('rel') == obj.type) {
					$(elem).addClass('active');
				} else {
					$(elem).addClass('disabled');
					$(elem).find('a').addClass('disabled');
				}
				
			});
			var content = rrsets.content;
			var type = obj.type;
			var ttl = obj.ttl; 
			///if(obj.type ==)
					switch(type) {
						case 'A':
							$('#edit-dns-a :input[name="name"]').val(dname);
							$('#edit-dns-a :input[name="type"]').val(type);
							$('#edit-dns-a :input[name="content"]').val(content);
							$('#edit-dns-a :input[name="ttl"]').val(ttl);
						break;
						case 'CNAME':
							content = content.substring(0,(content.length - 1));
							$('#edit-dns-cname :input[name="name"]').val(dname);
							$('#edit-dns-cname :input[name="type"]').val(type);
							$('#edit-dns-cname :input[name="content"]').val(content);
							$('#edit-dns-cname :input[name="ttl"]').val(ttl);
						break;
						case 'MX':
							content = content.substring(0,(content.length - 1));
							content = content.split(' ');

							$('#edit-dns-mx :input[name="name"]').val(dname);
							$('#edit-dns-mx :input[name="type"]').val(type);
							$('#edit-dns-mx :input[name="priority"]').val(content[0]);
							$('#edit-dns-mx :input[name="content"]').val(content[1]);
							$('#edit-dns-mx :input[name="ttl"]').val(ttl);
						break;
						case 'TXT':
							content = content.replace(/"/gi, "");
							$('#edit-dns-txt :input[name="name"]').val(dname);
							$('#edit-dns-txt :input[name="type"]').val(type);
							$('#edit-dns-txt :input[name="content"]').val(content);
							$('#edit-dns-txt :input[name="ttl"]').val(ttl);
						break;
						case 'SRV':
							content = content.substring(0,(content.length - 1));
							content = content.split(' ');
							$('#edit-dns-srv :input[name="name"]').val(dname);
							$('#edit-dns-srv :input[name="type"]').val(type);
							$('#edit-dns-srv :input[name="priority"]').val(content[0]);
							$('#edit-dns-srv :input[name="weight"]').val(content[1]);
							$('#edit-dns-srv :input[name="port"]').val(content[2]);
							$('#edit-dns-srv :input[name="content"]').val(content[3]);
							$('#edit-dns-srv :input[name="ttl"]').val(ttl);
						break;
					}				
			
			$("#edit-record-Modal").show();
}


function remove(element) {
	
	  var id = $('.dns-form-edit :input[name="id"]').val();
	  var obj = JSON.parse($(element).attr('data-obj')); 
	  var rrsets = JSON.parse($(element).attr('data-rrsets')); 
	  
	  bootbox.confirm({
						message: "Confirm Delete " + obj.name + "",
						size: 'large',
						title: '<i class="fa fa-trash" aria-hidden="true"></i> Delete Record',
						buttons: {
							confirm: {
								label: 'Yes',
								className: 'btn-danger'
							},
							cancel: {
								label: 'No',
								className: 'btn-success'
							}
						},
						callback: function (result) {
							if(result) {
								//Ajax Call To Delete the Record.
								$.ajax({
										  url: 'index.php?m=dns&action=delete&id='+id,
										  type: 'post',
										  data:  obj,
										  //async: false,
										  beforeSend: function () {
											  //Can we add anything here.
										  },
										  cache: true,
										  dataType: 'json',
										  crossDomain: true,
										  success: function (data) {
											  console.log(data);
											  if (data.code == 1) {
												  
												  swal({
														  title: "Success!",
														  text: data.message,
														  type: "success"
													  }, function() {
														  window.location = 'index.php?m=dns&id='+id+'&successmessage='+data.message;
													  });
												  
											  } else {
												  swal({
														  title: "Failure!",
														  text: data.message,
														  type: "warning"
													  }, function() {
														  window.location = 'index.php?m=dns&id='+id+'&failedmessage='+data.message;
													  });
											  }
										  },
										  error: function (data) {
											  console.log('Error:', data);
										  }
									  });
								
							}
							console.log('This was logged in the callback: ' + result);
						}
					  });
	
	
}



function updatettl(elem) {
	//Open the Modal of selected items
	//alert('YAY');
	if($('.bulk-actions').hasClass('disabled') == false) {
		$('#update-ttl-record-Modal').show();
		var obj = '[';

		$('#example tbody tr').each(function(index, element) {
			if($(element).hasClass('selected')) {
				//console.log(obj);
				obj += $(element).attr('data-obj');
			}
			//$('#mass-update-ttl input[name=data]').val(JSON.stringify(JSON.parse(obj)));
		});
		obj += ']';
		obj = obj.replace(/}{/g,"}, {");
		obj = JSON.stringify(obj);
		obj = JSON.parse(obj);
		$('#mass-update-ttl input[name=data]').val(obj);
	}
}


function deleteAll(elem) {

    var id = $('.dns-form-add :input[name="id"]').val();

	if($('.bulk-actions').hasClass('disabled') == false) {
		var obj = '[';

		$('#example tbody tr').each(function(index, element) {
			if($(element).hasClass('selected')) {
				obj += $(element).attr('data-obj');
			}			
		});
		obj += ']';
		obj = obj.replace(/}{/g,"}, {");
		//obj = JSON.stringify(obj);
		obj = JSON.parse(obj);
		console.log(obj);
		bootbox.confirm({
						message: "Confirm Delete ",
						size: 'large',
						title: '<i class="fa fa-trash" aria-hidden="true"></i> Delete Record',
						buttons: {
							confirm: {
								label: 'Yes',
								className: 'btn-danger'
							},
							cancel: {
								label: 'No',
								className: 'btn-success'
							}
						},
						callback: function (result) {
							if(result) {
								//Ajax Call To Delete the Record.
								$.ajax({
										  url: 'index.php?m=dns&action=deleteall&id='+id,
										  type: 'post',
										  data:  JSON.stringify(obj),
										  //async: false,
										  beforeSend: function () {
											  //Can we add anything here.
										  },
										  cache: true,
										  dataType: 'json',
										  crossDomain: true,
									      contentType: "application/json",
										  success: function (data) {
											  
											  if (data.code == 1) {
												  
												  swal({
														  title: "Success!",
														  text: data.message,
														  type: "success"
													  }, function() {
														  window.location = 'index.php?m=dns&id='+id+'&successmessage='+data.message;
													  });
												  
											  } else {
												  swal({
														  title: "Failure!",
														  text: data.message,
														  type: "warning"
													  }, function() {
														  window.location = 'index.php?m=dns&id='+id+'&failedmessage='+data.message;
													  });
											  }
										  },
										  error: function (data) {
											  console.log('Error:', data);
										  }
									  });
								
							}
							
						}
					  });
		
		


	}
}

$(function(){
//$("#add-record-Modal").show();
		// When the user clicks on <span> (x), close the modal
		$('.close').click(function(e) {
			$(".modal").hide();
		});
		
		// When the user clicks anywhere outside of the modal, close it
		$(window).click(function(e) {
			$(".record").each(function(i,el){
				if (e.target == el) {
					$(el).hide();
				}
			})
		})
		
		$("#create-record").click(function(e){
			$("#create-record-Modal").show();
		});
		
		$(".dns-form-add").keyup(function(e){
			var parentObject = $(this);
			parentObject.find('input[type="text"]').each(function(index,element){
				if($(element).val() == '') {
					parentObject.find('.create-record').addClass('disabled');
				} else {
					parentObject.find('.create-record').removeClass('disabled');

				}
			});
		});
		//create-record
		
		$(".dns-form-add").bind('submit' , function(e){
			e.preventDefault();
			if($(this).find('.create-record').hasClass('disabled') == false) {
				
				//Define The Type
				var type = $(this).find('input[name="type"]').val();
				var id = $(this).find('input[name="id"]').val();
				var domain = $(this).find('input[name="domain"]').val();
				//Validate the Content						
				var name = $(this).find('input[name="name"]').val();
				var content = $(this).find('input[name="content"]').val();
				var numbers = /^[0-9]+$/;
				var domainregEx = /^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/;
				var ipAddressRegEx = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
				var ttl = $(this).find('select[name="ttl"] option:selected').val();
				var dataObj = {};
				var error = false;
				
				if(name == '') {
					name = domain+'.';	
				} else {
					name = name+'.'+domain+'.';	
				}
				
				//Add Validations Based on Type
				switch(type) {
						
					case 'A':

				        if (!domainregEx.test(content)) {
							if(!ipAddressRegEx.test(content)) {
					
								bootbox.alert("Please Enter Valid Will Direct To.");
								$(this).find('input[name="content"]').focus();
								error = true;
							}
						}
						
					break;
					
					case 'CNAME':
						
				        if (!domainregEx.test(content)) {
							if(!ipAddressRegEx.test(content)) {
					
								bootbox.alert("Please Enter Valid Is An Alias Of.");
								$(this).find('input[name="content"]').focus();
								error = true;
							}
						}
						
						content = content+'.';
					
					break;
					
					case 'MX':
					
						//Validate the Content						
						var priority = $(this).find('select[name="priority"] option:selected').val();
				        if (!domainregEx.test(content)) {
							if(!ipAddressRegEx.test(content)) {
								bootbox.alert("Please Enter Valid Mail Provider Mail Server.");
								$(this).find('input[name="content"]').focus();
								error = true;
							}
						}
						
						content = priority+' '+content+'.';						
					
					break;
					
					case 'TXT':
					
						//Validate the Content						
						content = ''+content+'';
						
					break;
					
					case 'SRV':
					
						var priority = $(this).find('select[name="priority"] option:selected').val();
						var weight = $(this).find('input[name="weight"]').val();
						var port = $(this).find('input[name="port"]').val();
						
						
					
						if (!domainregEx.test(content)) {
							if(!ipAddressRegEx.test(content)) {
								bootbox.alert("Please Enter Valid Will Direct To.");
								$(this).find('input[name="content"]').focus();
								error = true;
							}
						}
						
						if(!weight.match(numbers)) {
							  bootbox.alert("Please Enter Valid Weight.");
							  $(this).find('input[name="weight"]').focus();
							  error = true;
						}
						
					
						if(!port.match(numbers)) {
							  bootbox.alert("Please Enter Valid Port.");
							  $(this).find('input[name="port"]').focus();
							  error = true;
						}
						
						content = priority+' '+weight+' '+port+' '+content+'.';						

					break;
					
				}
				
				var dataObj = {'name':name, 'type':type, 'ttl':ttl, 'content':content};
				
				if(!error) {
		        
					//Submit the Form using ajax
					$.ajax({
							  url: 'index.php?m=dns&action=submit&id='+id,
							  type: 'post',
							  data: dataObj,
							  //async: false,
							  beforeSend: function () {
								  //Can we add anything here.
							  },
							  cache: true,
							  dataType: 'json',
							  crossDomain: true,
							  success: function (data) {
								  if (data.code == 1) {
									  
									  swal({
											  title: "Success!",
											  text: data.message,
											  type: "success"
										  }, function() {
											  window.location = 'index.php?m=dns&id='+id+'&successmessage='+data.message;
										  });
									  
								  } else {
									  swal({
											  title: "Failure!",
											  text: data.message,
											  type: "warning"
										  }, function() {
											  //window.location = 'index.php?m=dns&id='+id+'&failedmessage='+data.message;
										  });
								  }
							  },
							  error: function (data) {
								  console.log('Error:', data);
							  }
						  });
				} //If Not Error
			
			} // END if($(this).find('.create-record').hasClass('disabled') == false)
			
			//alert("How");
		});
		
		
		$(".dns-form-edit").bind('submit' , function(e){
			e.preventDefault();
			//Lets Add the validation.	
				//Define The Type
				var type = $(this).find('input[name="type"]').val();
				var id = $(this).find('input[name="id"]').val();
				var domain = $(this).find('input[name="domain"]').val();
				//Validate the Content						
				var name = $(this).find('input[name="name"]').val();
				var content = $(this).find('input[name="content"]').val();
				var numbers = /^[0-9]+$/;
				var domainregEx = /^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/;
				var ipAddressRegEx = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
				var ttl = $(this).find('select[name="ttl"] option:selected').val();
				var dataObj = {};
				var error = false;
				
				//name = name+'.'+domain+'.';	
				if(name == '') {
					name = domain+'.';	
				} else {
					name = name+'.'+domain+'.';	
				}
				//Add Validations Based on Type
				switch(type) {
						
					case 'A':

				        if (!domainregEx.test(content)) {
							if(!ipAddressRegEx.test(content)) {
					
								bootbox.alert("Please Enter Valid Will Direct To.");
								$(this).find('input[name="content"]').focus();
								error = true;
							}
						}
						
					break;
					
					case 'CNAME':
						
				        if (!domainregEx.test(content)) {
							if(!ipAddressRegEx.test(content)) {
					
								bootbox.alert("Please Enter Valid Is An Alias Of.");
								$(this).find('input[name="content"]').focus();
								error = true;
							}
						}
						
						content = content+'.';
					
					break;
					
					case 'MX':
					
						//Validate the Content						
						var priority = $(this).find('select[name="priority"] option:selected').val();
				        if (!domainregEx.test(content)) {
							if(!ipAddressRegEx.test(content)) {
								bootbox.alert("Please Enter Valid Mail Provider Mail Server.");
								$(this).find('input[name="content"]').focus();
								error = true;
							}
						}
						
						content = priority+' '+content+'.';						
					
					break;
					
					case 'TXT':
					
						//Validate the Content						
						content = ''+content+'';
						
					break;
					
					case 'SRV':
					
						var priority = $(this).find('select[name="priority"] option:selected').val();
						var weight = $(this).find('input[name="weight"]').val();
						var port = $(this).find('input[name="port"]').val();
						
						
					
						if (!domainregEx.test(content)) {
							if(!ipAddressRegEx.test(content)) {
								bootbox.alert("Please Enter Valid Will Direct To.");
								$(this).find('input[name="content"]').focus();
								error = true;
							}
						}
						
						if(!weight.match(numbers)) {
							  bootbox.alert("Please Enter Valid Weight.");
							  $(this).find('input[name="weight"]').focus();
							  error = true;
						}
						
					
						if(!port.match(numbers)) {
							  bootbox.alert("Please Enter Valid Port.");
							  $(this).find('input[name="port"]').focus();
							  error = true;
						}
						
						content = priority+' '+weight+' '+port+' '+content+'.';						

					break;
					
				}
				
				var dataObj = {'name':name, 'type':type, 'ttl':ttl, 'content':content};

				if(!error) {
		        
					//Submit the Form using ajax
					$.ajax({
							  url: 'index.php?m=dns&action=submit&id='+id,
							  type: 'post',
							  data: dataObj,
							  //async: false,
							  beforeSend: function () {
								  //Can we add anything here.
							  },
							  cache: true,
							  dataType: 'json',
							  crossDomain: true,
							  success: function (data) {
								  if (data.code == 1) {
									  
									  swal({
											  title: "Success!",
											  text: data.message,
											  type: "success"
										  }, function() {
											  window.location = 'index.php?m=dns&id='+id+'&successmessage='+data.message;
										  });
									  
								  } else {
									  swal({
											  title: "Failure!",
											  text: data.message,
											  type: "warning"
										  }, function() {
											  //window.location = 'index.php?m=dns&id='+id+'&failedmessage='+data.message;
										  });
								  }
							  },
							  error: function (data) {
								  console.log('Error:', data);
							  }
						  });
				} //If Not Error
			
		});
		
				
		$("#mass-update-ttl").bind('submit' , function(e){
			var id = $(this).find('input[name="id"]').val();
			var domain = $(this).find('input[name="domain"]').val();
			var data = {};
			data = $(this).find('input[name="data"]').val();
			var newttl = $(this).find('select[name="newttl"] option:selected').val();
			//JSON.parse(JSON.stringify(JSON.parse(
			//data = JSON.stringify(data, null, 2);
			data = JSON.parse(data);
			
			
			
			
			var todata = {};
			todata = {"id" : id, "mode":'updatettl', "domain":domain, "newttl": newttl, "data": data};
			
			todata = JSON.stringify(todata, null, 2);
			todata = JSON.parse(todata);


			e.preventDefault();

					$.ajax({
							  url: 'index.php?m=dns&action=updatettl&id='+id,
							  type: 'post',
							  data: todata,
							  //async: false,
							  beforeSend: function () {
								  //Can we add anything here.
							  },
							  cache: true,
							  dataType: 'json',
							  crossDomain: true,
							  success: function (data) {
								  if (data.code == 1) {
									  
									  swal({
											  title: "Success!",
											  text: data.message,
											  type: "success"
										  }, function() {
											  window.location = 'index.php?m=dns&id='+id+'&successmessage='+data.message;
										  });
									  
								  } else {
									  swal({
											  title: "Failure!",
											  text: data.message,
											  type: "warning"
										  }, function() {
											  //window.location = 'index.php?m=dns&id='+id+'&failedmessage='+data.message;
										  });
								  }
							  },
							  error: function (data) {
								  console.log('Error:', data);
							  }
						  });
			
			//console.log($(this));			
		});
		
		
		let example = $('#example').DataTable({
			"info": false,
			"paging": false,
			"filter":false,
			"responsive": true,
			columnDefs: [{
				orderable: false,
				className: 'select-checkbox',
				targets: 0
			}],
			
			order: [
				[1, 'asc']
			]
		});
		
	$('#example').css( 'cursor', 'pointer' );
 
    $('#example tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
		
		$('.bulk-actions').addClass('disabled');
		$('#example tbody tr').each(function(index, element) {
			if($(element).hasClass('selected')) {
				
				$('.bulk-actions').removeClass('disabled');
			}
			//console.log(element);
		});
    });
 	

    
		
		
		example.on("click", "th.select-checkbox", function() {
			console.log('TRSD');
			if ($("th.select-checkbox").hasClass("selected")) {
				$('.bulk-actions').addClass('disabled');

				example.rows().deselect();
				$("th.select-checkbox").removeClass("selected");
			} else {
				$('.bulk-actions').removeClass('disabled');

				example.rows().select();
				$("th.select-checkbox").addClass("selected");
			}
		}).on("select deselect", function() {
			("Some selection or deselection going on")
			if (example.rows({
					selected: true
				}).count() !== example.rows().count()) {
				$("th.select-checkbox").removeClass("selected");
			} else {
				$("th.select-checkbox").addClass("selected");
			}
		});
		
		
	 
	//alert("WHY");


	
});

