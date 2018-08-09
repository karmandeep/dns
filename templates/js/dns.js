/*

Custom File file for Pluggin.

*/

//Power DNS EDIT
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


//cPanel DNS EDIT

function editcpanel(element) {
	
	var obj = JSON.parse($(element).attr('data-obj')); 
	var dname = $(element).attr('data-name'); 
	
	
	$('#edit-record-cpanel-Modal .type-selection ul li').each(function(index, elem) {
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
	
	
	var line = obj.Line;
	var type = obj.type;
	var ttl = obj.ttl; 
	var name = obj.name.replace('.'+dname+'.', '');	

	switch(type) {
		case 'A':
			$('#edit-dns-cpanel-a :input[name="line"]').val(line);
			$('#edit-dns-cpanel-a :input[name="name"]').val(name);
			$('#edit-dns-cpanel-a :input[name="type"]').val(type);
			$('#edit-dns-cpanel-a :input[name="address"]').val(obj.address);
			$('#edit-dns-cpanel-a :input[name="ttl"]').val(ttl);
		break;
		case 'CNAME':
			$('#edit-dns-cpanel-cname :input[name="line"]').val(line);
			$('#edit-dns-cpanel-cname :input[name="name"]').val(name);
			$('#edit-dns-cpanel-cname :input[name="type"]').val(type);
			$('#edit-dns-cpanel-cname :input[name="cname"]').val(obj.cname);
			$('#edit-dns-cpanel-cname :input[name="ttl"]').val(ttl);
		break;
		case 'MX':
			$('#edit-dns-cpanel-mx :input[name="line"]').val(line);
			$('#edit-dns-cpanel-mx :input[name="name"]').val(name);
			$('#edit-dns-cpanel-mx :input[name="type"]').val(type);
			$('#edit-dns-cpanel-mx :input[name="priority"]').val(obj.preference);
			$('#edit-dns-cpanel-mx :input[name="exchange"]').val(obj.exchange);
			$('#edit-dns-cpanel-mx :input[name="ttl"]').val(ttl);
		break;
		case 'TXT':
			$('#edit-dns-cpanel-txt :input[name="line"]').val(line);
			$('#edit-dns-cpanel-txt :input[name="name"]').val(name);
			$('#edit-dns-cpanel-txt :input[name="type"]').val(type);
			$('#edit-dns-cpanel-txt :input[name="txtdata"]').val(obj.txtdata);
			$('#edit-dns-cpanel-txt :input[name="ttl"]').val(ttl);
		break;
		case 'SRV':
			$('#edit-dns-cpanel-srv :input[name="line"]').val(line);
			$('#edit-dns-cpanel-srv :input[name="name"]').val(name);
			$('#edit-dns-cpanel-srv :input[name="type"]').val(type);
			$('#edit-dns-cpanel-srv :input[name="priority"]').val(obj.priority);
			$('#edit-dns-cpanel-srv :input[name="weight"]').val(obj.weight);
			$('#edit-dns-cpanel-srv :input[name="port"]').val(obj.port);
			$('#edit-dns-cpanel-srv :input[name="target"]').val(obj.target);
			$('#edit-dns-cpanel-srv :input[name="ttl"]').val(ttl);
		break;
	}
	
	
	$("#edit-record-cpanel-Modal").show();
}



//Power DNS Remove
function remove(element) {
	
	  //var id = $('.dns-form-edit :input[name="id"]').val();

	  if($('.dns-form-edit').find('input[name="hosting_id"]').length){
		  var hosting_id = $('.dns-form-edit :input[name="hosting_id"]').val(); 
		  var urlString = 'index.php?m=dns&action=delete&hosting_id='+hosting_id;
		  var reDirectUrl = 'index.php?m=dns&hosting_id='+hosting_id;
		  
	  } else {
		  var id = $('.dns-form-edit :input[name="id"]').val();
		  var urlString = 'index.php?m=dns&action=delete&id='+id;
		  var reDirectUrl = 'index.php?m=dns&id='+id;
	  }	  



	  //
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
										  url: urlString,
										  type: 'post',
										  data:  obj,
										  //async: false,
										  beforeSend: function () {
											  //Can we add anything here.
										  },
										  cache: true,
										  dataType: 'json',
										  crossDomain: true,
			  							  async: false,							  
										  success: function (data) {
											  console.log(data);
											  if (data.code == 1) {
												  
												  swal({
														  title: "Success!",
														  text: data.message,
														  type: "success"
													  }, function() {
														  window.location = reDirectUrl+'&successmessage='+data.message;
													  });
												  
											  } else {
												  swal({
														  title: "Failure!",
														  text: data.message,
														  type: "warning"
													  }, function() {
														  window.location = reDirectUrl+'&failedmessage='+data.message;
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


//cPanel DNS Remove
function removecpanel(zone , line) {
	
	  //var id = $('.dns-cpanel-form-add :input[name="id"]').val();

	  if($('.dns-cpanel-form-edit').find('input[name="hosting_id"]').length){
		  var hosting_id = $('.dns-cpanel-form-edit :input[name="hosting_id"]').val(); 
		  var urlString = 'index.php?m=dns&action=deletecpanel&hosting_id='+hosting_id;
		  var reDirectUrl = 'index.php?m=dns&hosting_id='+hosting_id;
	  } else {
		  var id = $('.dns-cpanel-form-edit :input[name="id"]').val();
		  var urlString = 'index.php?m=dns&action=deletecpanel&id='+id;
		  var reDirectUrl = 'index.php?m=dns&id='+id;
	  }	
	  var obj = {'zone':zone, 'line':line};

	 bootbox.confirm({
						message: "Confirm Delete",
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
								//The Code to Delete Here
								
								$.ajax({
										  url: urlString,
										  type: 'post',
										  data:  obj,
										  //async: false,
										  beforeSend: function () {
											  //Can we add anything here.
										  },
										  cache: true,
										  dataType: 'json',
										  crossDomain: true,
			  							  async: false,							  
										  success: function (data) {
											  //console.log(data);
											  if (data.code == 1) {
												  
												  swal({
														  title: "Success!",
														  text: data.message,
														  type: "success"
													  }, function() {
														  window.location = reDirectUrl+'&successmessage='+data.message;
													  });
												  
											  } else {
												  swal({
														  title: "Failure!",
														  text: data.message,
														  type: "warning"
													  }, function() {
														  window.location = reDirectUrl+'&failedmessage='+data.message;
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

//Power DNS Update TLD
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

//Power DNS Update TLD
function updatecpanelttl() {
	//Open the Modal of selected items
	if($('.bulk-actions').hasClass('disabled') == false) {
		$('#update-cpanel-ttl-record-Modal').show();
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
		$('#mass-update-cpanel-ttl input[name=data]').val(obj);
	}
}

//Power DNS DELETE all selected
function deleteAll(elem) {

    //var id = $('.dns-form-add :input[name="id"]').val();

	if($('.dns-form-edit').find('input[name="hosting_id"]').length){
		//'index.php?m=dns&action=deleteall&id='+id
		var hosting_id = $('.dns-form-edit :input[name="hosting_id"]').val(); 
		var urlString = 'index.php?m=dns&action=deleteall&hosting_id='+hosting_id;
		var reDirectUrl = 'index.php?m=dns&hosting_id='+hosting_id;
	} else {
		var id = $('.dns-form-edit :input[name="id"]').val();
		var urlString = 'index.php?m=dns&action=deleteall&id='+id;
		var reDirectUrl = 'index.php?m=dns&id='+id;
	}	


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
										  url: urlString,
										  type: 'post',
										  data:  JSON.stringify(obj),
										  //async: false,
										  beforeSend: function () {
											  //Can we add anything here.
										  },
										  cache: true,
										  dataType: 'json',
										  crossDomain: true,
			  							  async: false,							  
									      contentType: "application/json",
										  success: function (data) {
											  
											  if (data.code == 1) {
												  
												  swal({
														  title: "Success!",
														  text: data.message,
														  type: "success"
													  }, function() {
														  window.location = reDirectUrl+'&successmessage='+data.message;
													  });
												  
											  } else {
												  swal({
														  title: "Failure!",
														  text: data.message,
														  type: "warning"
													  }, function() {
														  window.location = reDirectUrl+'&failedmessage='+data.message;
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

//cPanel DNS DELETE all Selected
function deletecpanelAll() {
	
	
	//var id = $('.dns-cpanel-form-add :input[name="id"]').val();

	if($('.dns-cpanel-form-edit').find('input[name="hosting_id"]').length){
		//'index.php?m=dns&action=deleteall&id='+id
		var hosting_id = $('.dns-cpanel-form-edit :input[name="hosting_id"]').val(); 
		var urlString = 'index.php?m=dns&action=deleteallcpanel&hosting_id='+hosting_id;
		var reDirectUrl = 'index.php?m=dns&hosting_id='+hosting_id;
	} else {
		var id = $('.dns-cpanel-form-edit :input[name="id"]').val();
		var urlString = 'index.php?m=dns&action=deleteallcpanel&id='+id;
		var reDirectUrl = 'index.php?m=dns&id='+id;
	}	


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
										  url: urlString,
										  type: 'post',
										  data:  JSON.stringify(obj),
										  //async: false,
										  beforeSend: function () {
											  //Can we add anything here.
										  },
										  cache: true,
										  dataType: 'json',
										  async: false,
										  crossDomain: true,
									      contentType: "application/json",
										  success: function (data) {
											  
											  if (data.code == 1) {
												  
												  swal({
														  title: "Success!",
														  text: data.message,
														  type: "success"
													  }, function() {
														  window.location = reDirectUrl+'&successmessage='+data.message;
													  });
												  
											  } else {
												  swal({
														  title: "Failure!",
														  text: data.message,
														  type: "warning"
													  }, function() {
														  window.location = reDirectUrl+'&failedmessage='+data.message;
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


//Common
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
		
		
		//PowerDNS
		$("#create-record").click(function(e){
			$("#create-record-Modal").show();
		});
		
		
		//cPanelDNS
		$("#create-record-cpanel").click(function(e){
			$("#create-record-cpanel-Modal").show();
		});
		
		
		//PowerDNS Add
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


		//cPanelDNS Add
		$(".dns-cpanel-form-add").keyup(function(e){
			var parentObject = $(this);
			parentObject.find('input[type="text"]').each(function(index,element){
				if($(element).val() == '') {
					parentObject.find('.create-cpanel-record').addClass('disabled');
				} else {
					parentObject.find('.create-cpanel-record').removeClass('disabled');

				}
			});
		});
		
		//PowerDNS Functions
		$(".dns-form-add").bind('submit' , function(e){
			e.preventDefault();
			if($(this).find('.create-record').hasClass('disabled') == false) {
				
				//Define The Type
				var type = $(this).find('input[name="type"]').val();
				
				if($(this).find('input[name="hosting_id"]').length){
					var hosting_id = $(this).find('input[name="hosting_id"]').val();
					var urlString = 'index.php?m=dns&action=submit&hosting_id='+hosting_id;
					var reDirectUrl = 'index.php?m=dns&hosting_id='+hosting_id;
				} else {
					var id = $(this).find('input[name="id"]').val();
					var urlString = 'index.php?m=dns&action=submit&id='+id;
					var reDirectUrl = 'index.php?m=dns&id='+id;
				}

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
				
				dataObj = {'name':name, 'type':type, 'ttl':ttl, 'content':content};
				
				if(!error) {
		        
					//Submit the Form using ajax
					$.ajax({
							  url: urlString,
							  type: 'post',
							  data: dataObj,
							  //async: false,
							  beforeSend: function () {
								  //Can we add anything here.
							  },
							  cache: true,
							  dataType: 'json',
							  crossDomain: true,
  							  async: false,
							  success: function (data) {
								  if (data.code == 1) {
									  
									  swal({
											  title: "Success!",
											  text: data.message,
											  type: "success"
										  }, function() {
											  window.location = reDirectUrl + '&successmessage='+data.message;
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
				if($(this).find('input[name="hosting_id"]').length){
					var hosting_id = $(this).find('input[name="hosting_id"]').val();
					var urlString = 'index.php?m=dns&action=submit&hosting_id='+hosting_id;
					var reDirectUrl = 'index.php?m=dns&hosting_id='+hosting_id;
				} else {
					var id = $(this).find('input[name="id"]').val();
					var urlString = 'index.php?m=dns&action=submit&id='+id;
					var reDirectUrl = 'index.php?m=dns&id='+id;
				}
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
				
				dataObj = {'name':name, 'type':type, 'ttl':ttl, 'content':content};

				if(!error) {
		        
					//Submit the Form using ajax
					$.ajax({
							  url: urlString,
							  type: 'post',
							  data: dataObj,
							  //async: false,
							  beforeSend: function () {
								  //Can we add anything here.
							  },
							  cache: true,
							  dataType: 'json',
							  crossDomain: true,
							  async: false,
							  success: function (data) {
								  if (data.code == 1) {
									  
									  swal({
											  title: "Success!",
											  text: data.message,
											  type: "success"
										  }, function() {
											  window.location = reDirectUrl+'&successmessage='+data.message;
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
			//var id = $(this).find('input[name="id"]').val();

			if($(this).find('input[name="hosting_id"]').length){
				var hosting_id = $(this).find('input[name="hosting_id"]').val();
				
				var urlString = 'index.php?m=dns&action=updatettl&hosting_id='+hosting_id;
				var reDirectUrl = 'index.php?m=dns&hosting_id='+hosting_id;
			} else {
				var id = $(this).find('input[name="id"]').val();
				
				var urlString = 'index.php?m=dns&action=updatettl&id='+id;
				var reDirectUrl = 'index.php?m=dns&id='+id;
			}

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
							  url: urlString,
							  type: 'post',
							  data: todata,
							  //async: false,
							  beforeSend: function () {
								  //Can we add anything here.
							  },
							  cache: true,
							  dataType: 'json',
							  crossDomain: true,
							  async: false,
							  success: function (data) {
								  if (data.code == 1) {
									  
									  swal({
											  title: "Success!",
											  text: data.message,
											  type: "success"
										  }, function() {
											  window.location = reDirectUrl+'&successmessage='+data.message;
										  });
									  
								  } else {
									  swal({
											  title: "Failure!",
											  text: data.message,
											  type: "warning"
										  }, function() {
											  window.location = reDirectUrl+'&failedmessage='+data.message;
										  });
								  }
							  },
							  error: function (data) {
								  console.log('Error:', data);
							  }
						  });
			
			//console.log($(this));			
		});
		
		
		//cPanelDNS Functions
		$(".dns-cpanel-form-add").bind('submit' , function(e){
			e.preventDefault();
			if($(this).find('.create-cpanel-record').hasClass('disabled') == false) {
				
				//Define The Type
				var type = $(this).find('input[name="type"]').val();
				if($(this).find('input[name="hosting_id"]').length){
					var hosting_id = $(this).find('input[name="hosting_id"]').val();
					var urlString = 'index.php?m=dns&action=submitcpanel&hosting_id='+hosting_id;
					var reDirectUrl = 'index.php?m=dns&hosting_id='+hosting_id;
				} else {
					var id = $(this).find('input[name="id"]').val();
					var urlString = 'index.php?m=dns&action=submitcpanel&id='+id;
					var reDirectUrl = 'index.php?m=dns&id='+id;
				}
				var domain = $(this).find('input[name="domain"]').val();
				var content = {};
				var mode = $(this).find('input[name="mode"]').val();
				
				//Validate the Content						
				var name = $(this).find('input[name="name"]').val();
				var numbers = /^[0-9]+$/;
				var domainregEx = /^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/;
				var ipAddressRegEx = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
				var ttl = $(this).find('select[name="ttl"] option:selected').val();
				var dataObj = {};
				var error = false;
				
				if(name == '') {
					//name = domain;	
					bootbox.alert("Please Enter Valid Hostname.");
					$(this).find('input[name="name"]').focus();
					error = true;
				} /*else {
					name = name+'.'+domain;	
				}*/
				//name = name+'.'+domain;
				//Add Validations Based on Type
				switch(type) {
						
					case 'A':
					
						var address = $(this).find('input[name="address"]').val();
				        if (!domainregEx.test(address)) {
							if(!ipAddressRegEx.test(address)) {
					
								bootbox.alert("Please Enter Valid Will Direct To.");
								$(this).find('input[name="address"]').focus();
								error = true;
							}
						}
						
						content = {'address':address};

					break;
					
					case 'CNAME':
						
						var cname = $(this).find('input[name="cname"]').val();
				        if (!domainregEx.test(cname)) {
							if(!ipAddressRegEx.test(cname)) {
					
								bootbox.alert("Please Enter Valid Is An Alias Of.");
								$(this).find('input[name="cname"]').focus();
								error = true;
							}
						}
						
						content = {'cname':cname};
					
					break;
					
					case 'MX':
					
						
						var exchange = $(this).find('input[name="exchange"]').val();
						//Validate the Content						
						var priority = $(this).find('select[name="priority"] option:selected').val();
				        if (!domainregEx.test(exchange)) {
							if(!ipAddressRegEx.test(exchange)) {
								bootbox.alert("Please Enter Valid Mail Provider Mail Server.");
								$(this).find('input[name="exchange"]').focus();
								error = true;
							}
						}
						
						content = {'exchange':exchange , 'priority':priority};

						//content = priority+' '+content+'.';						
					
					break;
					
					case 'TXT':
					
						var txtdata = $(this).find('input[name="txtdata"]').val();
						
						content = {'txtdata':txtdata};

						//Validate the Content						
						//content = ''+content+'';
						
					break;
					
					case 'SRV':
					
						var target = $(this).find('input[name="target"]').val();

						
						var priority = $(this).find('select[name="priority"] option:selected').val();
						var weight = $(this).find('input[name="weight"]').val();
						var port = $(this).find('input[name="port"]').val();
						
						
					
						if (!domainregEx.test(target)) {
							if(!ipAddressRegEx.test(target)) {
								bootbox.alert("Please Enter Valid Will Direct To.");
								$(this).find('input[name="target"]').focus();
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
						
						content = {'target':target, 'priority':priority, 'weight':weight, 'port':port};

					break;
					
				}
				
				dataObj = {'name':name, 'type':type, 'ttl':ttl, 'content':content, 'mode':mode};
				
				if(!error) {
		        
					//Submit the Form using ajax
					$.ajax({
							  url: urlString,
							  type: 'post',
							  data: dataObj,
							  //async: false,
							  beforeSend: function () {
								  //Can we add anything here.
							  },
							  cache: true,
							  dataType: 'json',
							  crossDomain: true,
							  async: false,
							  success: function (data) {
								  if (data.code == 1) {
									  
									  swal({
											  title: "Success!",
											  text: data.message,
											  type: "success"
										  }, function() {
											  window.location = reDirectUrl+'&successmessage='+data.message;
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

		
		$(".dns-cpanel-form-edit").bind('submit' , function(e){
			e.preventDefault();
			//Lets Add the validation.	
				//Define The Type
				var type = $(this).find('input[name="type"]').val();
				if($(this).find('input[name="hosting_id"]').length){
					var hosting_id = $(this).find('input[name="hosting_id"]').val();
					var urlString = 'index.php?m=dns&action=submitcpanel&hosting_id='+hosting_id;
					var reDirectUrl = 'index.php?m=dns&hosting_id='+hosting_id;
				} else {
					var id = $(this).find('input[name="id"]').val();
					var urlString = 'index.php?m=dns&action=submitcpanel&id='+id;
					var reDirectUrl = 'index.php?m=dns&id='+id;
				}
				var domain = $(this).find('input[name="domain"]').val();
				var content = {};
				var line = $(this).find('input[name="line"]').val();
				var mode = $(this).find('input[name="mode"]').val();

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
					//name = domain;	
					bootbox.alert("Please Enter Valid Hostname.");
					$(this).find('input[name="name"]').focus();
					error = true;
				}/* else {
					name = name+'.'+domain+'.';	
				}*/
				
				//Add Validations Based on Type
				switch(type) {
						
					case 'A':
					
						var address = $(this).find('input[name="address"]').val();
				        if (!domainregEx.test(address)) {
							if(!ipAddressRegEx.test(address)) {
					
								bootbox.alert("Please Enter Valid Will Direct To.");
								$(this).find('input[name="address"]').focus();
								error = true;
							}
						}
						
						content = {'address':address};

					break;
					
					case 'CNAME':
						
						var cname = $(this).find('input[name="cname"]').val();
				        if (!domainregEx.test(cname)) {
							if(!ipAddressRegEx.test(cname)) {
					
								bootbox.alert("Please Enter Valid Is An Alias Of.");
								$(this).find('input[name="cname"]').focus();
								error = true;
							}
						}
						
						content = {'cname':cname};
					
					break;
					
					case 'MX':
					
						
						var exchange = $(this).find('input[name="exchange"]').val();
						//Validate the Content						
						var priority = $(this).find('select[name="priority"] option:selected').val();
				        if (!domainregEx.test(exchange)) {
							if(!ipAddressRegEx.test(exchange)) {
								bootbox.alert("Please Enter Valid Mail Provider Mail Server.");
								$(this).find('input[name="exchange"]').focus();
								error = true;
							}
						}
						
						content = {'exchange':exchange , 'priority':priority};

						//content = priority+' '+content+'.';						
					
					break;
					
					case 'TXT':
					
						var txtdata = $(this).find('input[name="txtdata"]').val();
						
						content = {'txtdata':txtdata};

						//Validate the Content						
						//content = ''+content+'';
						
					break;
					
					case 'SRV':
					
						var target = $(this).find('input[name="target"]').val();

						
						var priority = $(this).find('select[name="priority"] option:selected').val();
						var weight = $(this).find('input[name="weight"]').val();
						var port = $(this).find('input[name="port"]').val();
						
						
					
						if (!domainregEx.test(target)) {
							if(!ipAddressRegEx.test(target)) {
								bootbox.alert("Please Enter Valid Will Direct To.");
								$(this).find('input[name="target"]').focus();
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
						
						content = {'target':target, 'priority':priority, 'weight':weight, 'port':port};

					break;
					
				}
				
				dataObj = {'name':name, 'type':type, 'ttl':ttl, 'content':content, 'mode':mode, 'line':line};

				if(!error) {
		        
					//Submit the Form using ajax
					$.ajax({
							  url: urlString,
							  type: 'post',
							  data: dataObj,
							  //async: false,
							  beforeSend: function () {
								  //Can we add anything here.
							  },
							  cache: true,
							  dataType: 'json',
							  crossDomain: true,
							  async: false,
							  success: function (data) {
								  if (data.code == 1) {
									  
									  swal({
											  title: "Success!",
											  text: data.message,
											  type: "success"
										  }, function() {
											  window.location = reDirectUrl+'&successmessage='+data.message;
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
		
		$("#mass-update-cpanel-ttl").bind('submit' , function(e){
			
			//var id = $(this).find('input[name="id"]').val();
			
			if($(this).find('input[name="hosting_id"]').length){
				var hosting_id = $(this).find('input[name="hosting_id"]').val();
				
				var urlString = 'index.php?m=dns&action=updatettlcpanel&hosting_id='+hosting_id;
				var reDirectUrl = 'index.php?m=dns&hosting_id='+hosting_id;
			} else {
				var id = $(this).find('input[name="id"]').val();
				
				var urlString = 'index.php?m=dns&action=updatettlcpanel&id='+id;
				var reDirectUrl = 'index.php?m=dns&id='+id;
			}
			
			var mode = $(this).find('input[name="mode"]').val();
			var domain = $(this).find('input[name="domain"]').val();
			var data = {};
			data = $(this).find('input[name="data"]').val();
			var newttl = $(this).find('select[name="newttl"] option:selected').val();
			//JSON.parse(JSON.stringify(JSON.parse(
			//data = JSON.stringify(data, null, 2);
			data = JSON.parse(data);
			
			
			
			
			var todata = {};
			todata = {"id" : id, "mode":mode, "domain":domain, "newttl": newttl, "data": data};
			
			todata = JSON.stringify(todata, null, 2);
			todata = JSON.parse(todata);


			e.preventDefault();

					$.ajax({
							  url: urlString,
							  type: 'post',
							  data: todata,
							  //async: false,
							  beforeSend: function () {
								  //Can we add anything here.
							  },
							  cache: true,
							  dataType: 'json',
							  crossDomain: true,
							  async: false,							  
							  success: function (data) {
								  if (data.code == 1) {
									  
									  swal({
											  title: "Success!",
											  text: data.message,
											  type: "success"
										  }, function() {
											  window.location = reDirectUrl+'&successmessage='+data.message;
										  });
									  
								  } else {
									  swal({
											  title: "Failure!",
											  text: data.message,
											  type: "warning"
										  }, function() {
											  window.location = reDirectUrl+'&failedmessage='+data.message;
										  });
								  }
							  },
							  error: function (data) {
								  console.log('Error:', data);
							  }
						  });
			
			//console.log($(this));			
		});
		
		//Comman to both cPanel and PowerDNS
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
		
		
	 
		
		//cpanelDNS 
		
	
});

