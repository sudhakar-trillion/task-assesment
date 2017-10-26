
$(document).ready(function() {
	
	$(".view-task").on('click',function()
	{
		
		var ide = $(this).attr('id');
		
		$.ajax({
					url:base_url+'Requestdispatcher/gettask',
					type:"POST",
					data:{"id":ide},
					success:function(resp){ $(".modal-body").html(''); $(".modal-body").html(resp); }
				});
	});
	
	$(".delete_task").on('click',function()
	{
		var OnClick = $(this);
		var url      = window.location.href.split("/");
				//sam@fininfocom.com
		var paginate = url[(url.length)-1];
		
		if( confirm('Do you wants to delete') )
		{
			var ide = $(this).attr('deltask');
		
			$.ajax({
					url:base_url+'Requestdispatcher/deletetask',
					type:"POST",
					data:{"id":ide},
					success:function(resp)
					{ 
						resp = $.trim(resp);
					
						if(resp == "1")
						{
							
							
							OnClick.parent().parent().parent().remove();
							
							if(paginate.match(/[a-zA-Z]/))
							{
								var slncnt =0;
								
								$(".SLNO").each(function() 
								{ 
								slncnt = (slncnt)+1;
								$(this).html(slncnt);
								console.log(slncnt);
								});	
							}
							else
							{
								if($(".data-row").length==0)
								{
									 paginate = parseInt( paginate );
									  paginate  =  paginate-1;
									  
									  if( paginate == 1 )
									  {
										location.href=base_url+"view-tasks";  
									  }
									  else
									  {
										  location.href=base_url+"view-tasks/"+paginate;
									  }
								}
								else
								{
									var pgecnt = paginate-1;
									pgecnt = parseInt(pgecnt);
									pgecnt = pgecnt*10;
									
									var slncnt =pgecnt;
									
									$(".SLNO").each(function() 
									{ 
									slncnt = (slncnt)+1;
									$(this).html(slncnt);
									console.log(slncnt);
									});		
								}
							}
							
							

							
							
						}
						else if(resp == "0")
						{
							alert('Unable to delte');
						}
						else if(resp == "-1")
						{
							alert("Invalid request");
						}
					 }
				});
			
			
			
		}
		
	
		
	});

	
	});