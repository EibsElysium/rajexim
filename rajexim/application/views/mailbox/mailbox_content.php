<!-- <div class="row">
	<div class="col-md-3">
        <div class="panel">
            <div class="pad-all bord-btm">
                <a href="javascript:;" onclick="compose_mail();" class="btn btn-block btn-primary"><i class="fa fa-plus"></i>&nbsp; &nbsp; Compose</a>
                <input type="hidden" name="email_name" id="email_name" value="<?php echo $email_name; ?>">
            </div>
        </div>
    </div>
    <div class="col-md-3">
    	<div class="panel">
    	<div class="list-group bg-trans pad-btm bord-btm">
                <a href="javascript:;" onclick="get_info_email_list();" class="list-group-item text-semibold text-main">

                     <span class="badge badge-success pull-right" id="inbox_unread"></span> 
                    <span class="text-main"><i class="mailbox-pli-inbox-full icon-lg icon-fw"></i> Inbox</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    	<div class="panel">
    	<div class="list-group bg-trans pad-btm bord-btm">
    	 	<a href="javascript:;" onclick="get_info_sent_email_list();" class="list-group-item text-semibold text-main">
                     <span class="badge badge-success pull-right" id="sent_unread"></span> 
                    <span class="text-main"><i class="la la-send mail_la_ico" style="font-size: 21px;"></i> Sent Items</span>
                </a>
         </div>
     </div>
    </div>
    <div class="col-md-3">
    	<div class="panel">
    	<div class="list-group bg-trans pad-btm bord-btm">
    		<a href="javascript:;" onclick="get_info_draft_email_list();" class="list-group-item text-semibold text-main">
                     <span class="badge badge-success pull-right" id="draft_unread"></span> 
                    <span class="text-main"><i class="la la-file-text mail_la_ico" style="font-size: 21px;"></i> Drafts</span>
                </a>
         </div>
     </div>
    </div>
</div> -->
<style>
	.tap_size {
		height: 31px;
	}
	.mail-attach .move_to_bin{
		visibility:hidden;
	}
	.mail-attach:hover .move_to_bin{
		visibility:visible;
		cursor: pointer;

	}
	
</style>
<div class="row">
	<div class="col-md-12">
	    <div style="margin-bottom:2.2rem;">
	          <ul class="que_sett">
	             <!-- <li class=""><a class="tap_size" href="javascript:;" onclick="compose_mail();"><i class="fa fa-plus"></i>&nbsp; &nbsp;Compose</a></li> -->
	             <li class=""><button type="button" onclick="compose_mail();" class="btn btn-primary tap_size"><i class="fa fa-plus"></i>&nbsp; &nbsp;Compose</button></li>
	             <input type="hidden" name="email_name" id="email_name" value="<?php echo $email_name; ?>">

	             <li class=""><button type="button" onclick="get_info_email_list();" class="btn btn-primary tap_size"><i class="mailbox-pli-inbox-full icon-lg icon-fw"></i>&nbsp; &nbsp;Inbox</button></li>
	             <!-- <li class="" ><a class="tap_size" href="javascript:;" onclick="get_info_email_list();"><i class="mailbox-pli-inbox-full icon-lg icon-fw"></i>&nbsp; &nbsp;Inbox</a></li> -->

	             <li class=""><button type="button" onclick="get_info_sent_email_list();" class="btn btn-primary tap_size"><i class="la la-send mail_la_ico" style="font-size: 21px;"></i> &nbsp; &nbsp;Sent Items</button></li>

	             <!-- <li class="" ><a class="tap_size" href="javascript:;" onclick="get_info_sent_email_list();"><i class="la la-send mail_la_ico" style="font-size: 21px;"></i> &nbsp; &nbsp;Sent Items</a></li> -->
	             <li class=""><button type="button" onclick="get_info_draft_email_list();" class="btn btn-primary tap_size"><i class="la la-file-text mail_la_ico" style="font-size: 21px;"></i> &nbsp; &nbsp;Drafts</button></li>

	             <li class=""><button type="button" onclick="get_info_bin_email_list();" class="btn btn-primary tap_size"><i class="la la-trash mail_la_ico" style="font-size: 21px;"></i> &nbsp; &nbsp;Bin</button></li>
	             
	             <li class="pull-right">
	             	<div class="row">
	             		<div class="col-md-5">
	             			<select id="search_criteria" class="form-control ">
	             				<option value="FROM">FROM</option>
	             				<option value="TO">TO</option>
	             				<option value="CC">CC</option>
	             				<option value="BCC">BCC</option>
	             				<option value="TEXT">BODY</option>
	             				<option value="KEYWORD">KEYWORD</option>
	             				<option value="SUBJECT">SUBJECT</option>
	             			</select>
	             		</div>
	             		<div class="col-md-4">
	             			<input type="text" id="mailbox_search" class="mailbox_search form-control" style="width: 216px;" value="" placeholder="Search..">
	             		</div>
	             		
	             		<div class="col-md-3">
	             			<button style="width: 62px;padding: 6px;" class="btn btn-primary btn-sm" onclick="search_on_mailbox();"><i class="fa fa-search"></i></button>
	             		</div>
	             	</div>
				</li>
	             <!-- <li class=""><a href="<?php echo base_url(); ?>assets/Mail_timing/Fetch_time/mail_fetch_log.txt" target="_blank" class="btn btn-primary tap_size"><i class="la la-clock mail_la_ico" style="font-size: 21px;"></i> &nbsp; &nbsp;Fetching Time</a></li> -->
	             <!-- <li class="" ><a class="tap_size" href="javascript:;" onclick="get_info_draft_email_list();"><i class="la la-file-text mail_la_ico" style="font-size: 21px;"></i> &nbsp; &nbsp;Drafts</a></li> -->
	          </ul>
	    </div>
	</div>
</div> 

<div class="row">
    <div class="col-md-12" id="email_list_view">
    	<!-- Image loader -->
		<div id='loader' style='display: none;'>
		   <div class="se-pre-con">
		   	
		   </div>
		</div>
		<!-- Image loader -->
    </div>
    <input type="hidden" name="start" id="start" value="<?php echo $start; ?>">
    <input type="hidden" name="end" id="end" value="<?php echo $end; ?>">
    <input type="hidden" name="per_page" id="per_page" value="<?php echo $per_page; ?>">
    <input type="hidden" name="mail_list_count" id="mail_list_count" value="<?php echo $mail_list_count; ?>">
    <input type="hidden" name="tot_mail_list_count" id="tot_mail_list_count" value="<?php echo $tot_mail_list_count; ?>">
    <input type="hidden" name="displayed_mail_list_count" id="displayed_mail_list_count" value="<?php echo $displayed_mail_list_count; ?>">
	   

	<input type="hidden" id="search_for_flag" value="">
</div>
<div class="container">
   <div class="modal fade" id="move_to_bin_modal" data-keyboard="false" data-backdrop = "static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title text-left" id="exampleModalLabel">Move to Bin</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
               <div class="modal-body">
               	<h5>Are you sure, Do you want to move this email to Bin ?</h5>
                  <input type="hidden" name="bin_email_id" id="bin_email_id">
                  <input type="hidden" name="bin_uid" id="bin_uid">
                  <input type="hidden" name="bin_email_list_last_id" id="bin_email_list_last_id">
               </div>
               <div class="modal-footer">
                 <button type="button" id="move_to_bin_yes_btn" onclick="confirmed_move_to_bin();" class="btn btn-primary">Yes</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
               </div>
         </div>
      </div>
   </div>
</div>
<script>
	$(document).ready(function(){
		get_info_email_list();
	});
	function get_info_email_list()
	{	
		$('#search_for_flag').val('1');
		$('#mail_loader_indicator').show();
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		var emailid = $('#info_email').val();
		var start = $('#start').val();
		var end = $('#end').val();
		var per_page = $('#per_page').val();
		var mail_list_count = $('#mail_list_count').val();
		var tot_mail_list_count = $('#tot_mail_list_count').val();
		var displayed_mail_list_count = $('#displayed_mail_list_count').val();
		var mailbox_array = '<?php echo str_replace("'","`",json_encode($mail_lists)); ?>';

		//alert(mailbox_array);
		$.ajax({
		type: "POST",
		url: baseurl+'Mailbox/info_email_list',
		
		type: "POST",
		data:{'emailid':emailid, 'start':start, 'end':end, 'per_page' : per_page, 'mail_list_count' : tot_mail_list_count, 'mailbox_array': mailbox_array, 'tot_mail_list_count' : tot_mail_list_count, 'displayed_mail_list_count' : displayed_mail_list_count},
		dataType: "html",
		success: function(response)
		{
			$('#email_calling').hide();
			$('#mailbox_container_div').removeClass("mailbox_load_opacity");
			$('#mail_loader_indicator').hide();
			$('#email_list_view').empty().append(response);	
		}
		
		});
	}

	function search_on_mailbox()
	{
		$('#mail_loader_indicator').show();
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		var emailid = $('#info_email').val();
		var search_for_flag = $('#search_for_flag').val();
		var mailbox_search = $('#mailbox_search').val();
		var search_criteria = $('#search_criteria').val();

		// var start = $('#start').val();
		// var end = $('#end').val();
		// var per_page = $('#per_page').val();
		// var mail_list_count = $('#mail_list_count').val();
		// var tot_mail_list_count = $('#tot_mail_list_count').val();
		// var displayed_mail_list_count = $('#displayed_mail_list_count').val();
		// var mailbox_array = '<?php echo str_replace("'","`",json_encode($mail_lists)); ?>';
		//alert(mailbox_array);

		$.ajax({
			type: "POST",
			url: baseurl+'Mailbox/search_based_email_list',
			type: "POST",
			data:{'emailid':emailid,'search_for_flag':search_for_flag,'mailbox_search':mailbox_search,'search_criteria':search_criteria },
			dataType: "html",
			success: function(response)
			{
				$('#email_calling').hide();
				$('#mailbox_container_div').removeClass("mailbox_load_opacity");
				$('#mail_loader_indicator').hide();
				$('#email_list_view').empty().append(response);	
			}
		});
	}
	$(document).ready(function(){
		get_unread_mails_count();
	});
	function get_unread_mails_count()
	{
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		$('#mail_loader_indicator').show();
		var emailid = $('#info_email').val();
		$.ajax({
			type: "POST",
			url: baseurl+'Mailbox/get_unread_mails_count',
			
			type: "POST",
			data:{'emailid':emailid},
			dataType: "html",
			success: function(response)
			{
				$('#email_calling').hide();
				$('#mailbox_container_div').removeClass("mailbox_load_opacity");
				$('#mail_loader_indicator').hide();
				var res_array = response.split('|');
				// setInterval(function(){
				//     $('#inbox_unread').append(res_array[0]);
				// 	$('#sent_unread').append(res_array[1]);
				// 	$('#draft_unread').append(res_array[2]);
				// }, 2000);
				if (res_array[0] != 0) {
					// $('#inbox_unread').append(res_array[0]);
				}
				else {
					$('#inbox_unread').hide();
				}
				$('#sent_unread').append(res_array[1]);
				$('#draft_unread').append(res_array[2]);
			}
		});
	}
	function get_another_part_of_list(second_index,first_index,start,end,attach)
    {
    	$('#email_calling').show();
    	$('#mailbox_container_div').addClass("mailbox_load_opacity");
    	$('#mail_loader_indicator').show();
        var emailid = $('#info_email').val();
        var per_page = '<?php echo $per_page; ?>';
        var mail_list_count = $('#tot_mail_list_count').val();
       
        $.ajax({
            type: "POST",
            url: baseurl+'Mailbox/get_pagination_based_email_list',
            
            type: "POST",
            data:{'emailid':emailid, 'second_index':second_index, 'first_index':first_index, 'per_page' : per_page, 'start':start, 'end':end, 'tot_mail_list_count' : mail_list_count, 'attach':attach},
            dataType: "html",
            success: function(response)
            {
            	$('#email_calling').hide();
            	$('#mailbox_container_div').removeClass("mailbox_load_opacity");
            	$('#mail_loader_indicator').hide();
                $('#email_list_view').empty().append(response);
                
            }
        
        });
    }
	function get_info_sent_email_list()
	{
		$('#search_for_flag').val('2');
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		$('#mail_loader_indicator').show();
		var emailid = $('#info_email').val();
		//alert(mailbox_array);
		$.ajax({
		type: "POST",
		url: baseurl+'Mailbox/info_sent_email_list',
		
		type: "POST",
		data:{'emailid':emailid},
		dataType: "html",
		success: function(response)
		{
			$('#email_calling').hide();
			$('#mailbox_container_div').removeClass("mailbox_load_opacity");
			$('#mail_loader_indicator').hide();
			$('#email_list_view').empty().append(response);	
		}
		
		});
	}
	function get_another_part_of_sent_list(second_index,first_index,start,end, tot_sent_mail,attach)
    {
    	$('#email_calling').show();
    	$('#mailbox_container_div').addClass("mailbox_load_opacity");
    	$('#mail_loader_indicator').show();
        var emailid = $('#info_email').val();
        var per_page = '<?php echo $per_page; ?>';

        $.ajax({
            type: "POST",
            url: baseurl+'Mailbox/get_send_pagination_based_email_list',
            
            type: "POST",
            data:{'emailid':emailid, 'second_index':second_index, 'first_index':first_index, 'per_page' : per_page, 'start':start, 'end':end, 'tot_mail_list_count' : tot_sent_mail, 'attach' : attach},
            dataType: "html",
            success: function(response)
            {
            	$('#email_calling').hide();
            	$('#mailbox_container_div').removeClass("mailbox_load_opacity");
            	$('#mail_loader_indicator').hide();
                $('#email_list_view').empty().append(response);
                
            }
        });
    }
    
    function get_another_part_of_draft_list(second_index,first_index,start,end, tot_sent_mail)
    {
    	$('#email_calling').show();
    	$('#mailbox_container_div').addClass("mailbox_load_opacity");
    	$('#mail_loader_indicator').show();
        var emailid = $('#info_email').val();
        var per_page = '<?php echo $per_page; ?>';
       
        $.ajax({
            type: "POST",
            url: baseurl+'Mailbox/get_draft_pagination_based_email_list',
            
            type: "POST",
            data:{'emailid':emailid, 'second_index':second_index, 'first_index':first_index, 'per_page' : per_page, 'start':start, 'end':end, 'tot_mail_list_count' : tot_sent_mail},
            dataType: "html",
            success: function(response)
            {
            	$('#email_calling').hide();
            	$('#mailbox_container_div').removeClass("mailbox_load_opacity");
            	$('#mail_loader_indicator').hide();
                $('#email_list_view').empty().append(response);
            }
        });

    }
    function get_another_part_of_bin_list(second_index,first_index,start,end, tot_sent_mail)
    {
    	$('#email_calling').show();
    	$('#mailbox_container_div').addClass("mailbox_load_opacity");
    	$('#mail_loader_indicator').show();
        var emailid = $('#info_email').val();
        var per_page = '<?php echo $per_page; ?>';

        $.ajax({
            type: "POST",
            url: baseurl+'Mailbox/get_bin_pagination_based_email_list',
            async: false,
            type: "POST",
            data:{'emailid':emailid, 'second_index':second_index, 'first_index':first_index, 'per_page' : per_page, 'start':start, 'end':end, 'tot_mail_list_count' : tot_sent_mail},
            dataType: "html",
            success: function(response)
            {
                $('#email_calling').hide();
            	$('#mailbox_container_div').removeClass("mailbox_load_opacity");
            	$('#mail_loader_indicator').hide();
                $('#email_list_view').empty().append(response);
            }
        });
    }
	function get_info_draft_email_list()
	{
		$('#search_for_flag').val('3');
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		$('#mail_loader_indicator').show();
		var emailid = $('#info_email').val();
		//alert(mailbox_array);
		$.ajax({
		type: "POST",
		url: baseurl+'Mailbox/info_draft_email_list',
		
		type: "POST",
		data:{'emailid':emailid},
		dataType: "html",
		success: function(response)
		{
			$('#email_calling').hide();
			$('#mailbox_container_div').removeClass("mailbox_load_opacity");
			$('#mail_loader_indicator').hide();
			$('#email_list_view').empty().append(response);	
		}
		
		});
	}
	function get_info_bin_email_list()
	{
		$('#search_for_flag').val('4');
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		$('#mail_loader_indicator').show();
		var emailid = $('#info_email').val();
		//alert(mailbox_array);
		$.ajax({
		type: "POST",
		url: baseurl+'Mailbox/info_bin_email_list',
		
		type: "POST",
		data:{'emailid':emailid},
		dataType: "html",
		success: function(response)
		{
			$('#email_calling').hide();
			$('#mailbox_container_div').removeClass("mailbox_load_opacity");
			$('#mail_loader_indicator').hide();
			$('#email_list_view').empty().append(response);	
		}
		
		});
	}
	function imap_mailbox_view(msgno, label, start, end, per_page, first_index, second_index)
	{
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		$('#mail_loader_indicator').show();
		var emailid = $('#info_email').val();
		var tot_mail_list_count = '<?php echo $tot_mail_list_count; ?>';
		$.ajax({
		type: "POST",
		url: baseurl+'Mailbox/imap_mailbox_view',
		
		type: "POST",
		data:{'emailid':emailid, 'msgno':msgno, 'label':label, 'start' : start, 'end' : end, 'per_page' : per_page, 'tot_mail_list_count' : tot_mail_list_count, 'first_index' : first_index, 'second_index' : second_index },
		dataType: "html",
		success: function(response)
		{
			$('#email_calling').hide();
			$('#mailbox_container_div').removeClass("mailbox_load_opacity");
			$('#mail_loader_indicator').hide();
			$('#email_list_view').empty().append(response);
			
		}
		});

	}
	function search_imap_mailbox_view(msgno, label, flag, search_criteria)
	{
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		$('#mail_loader_indicator').show();
		var emailid = $('#info_email').val();
		$.ajax({
		type: "POST",
		url: baseurl+'Mailbox/imap_mailbox_view_search',
		
		type: "POST",
		data:{'emailid':emailid, 'msgno':msgno, 'label':label, 'flag': flag, 'search_criteria': search_criteria },
		dataType: "html",
		success: function(response)
		{
			$('#email_calling').hide();
			$('#mailbox_container_div').removeClass("mailbox_load_opacity");
			$('#mail_loader_indicator').hide();
			$('#email_list_view').empty().append(response);
			
		}
		});

	}

	function get_search_back(flag,attach,search_criteria)
	{
		$('#mail_loader_indicator').show();
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		var emailid = $('#info_email').val();
		var search_for_flag = $('#search_for_flag').val();
		var mailbox_search = $('#mailbox_search').val();

		$.ajax({
			type: "POST",
			url: baseurl+'Mailbox/search_based_email_list',
			type: "POST",
			data:{'emailid':emailid,'search_for_flag':search_for_flag,'mailbox_search':mailbox_search, 'attach':attach, 'search_criteria' : search_criteria},
			dataType: "html",
			success: function(response)
			{
				$('#email_calling').hide();
				$('#mailbox_container_div').removeClass("mailbox_load_opacity");
				$('#mail_loader_indicator').hide();
				$('#email_list_view').empty().append(response);	
			}
		});
	}
	function sent_imap_mailbox_view(msgno, label, start, end, per_page, tot_sent_mail, first_index, second_index)
	{
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		$('#mail_loader_indicator').show();
		var emailid = $('#info_email').val();
		
		$.ajax({
		type: "POST",
		url: baseurl+'Mailbox/sent_imap_mailbox_view',
		
		type: "POST",
		data:{'emailid':emailid, 'msgno':msgno, 'label':label, 'start' : start, 'end' : end, 'per_page' : per_page, 'tot_mail_list_count' : tot_sent_mail, 'first_index' : first_index, 'second_index' : second_index},
		dataType: "html",
		success: function(response)
		{
			$('#email_calling').hide();
			$('#mailbox_container_div').removeClass("mailbox_load_opacity");
			$('#mail_loader_indicator').hide();
			$('#email_list_view').empty().append(response);
			
		}
		});

	}
	function bin_imap_mailbox_view(msgno, label, start, end, per_page, tot_sent_mail, first_index, second_index)
	{
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		$('#mail_loader_indicator').show();
		var emailid = $('#info_email').val();
		
		$.ajax({
		type: "POST",
		url: baseurl+'Mailbox/bin_imap_mailbox_view',
		
		type: "POST",
		data:{'emailid':emailid, 'msgno':msgno, 'label':label, 'start' : start, 'end' : end, 'per_page' : per_page, 'tot_mail_list_count' : tot_sent_mail, 'first_index' : first_index, 'second_index' : second_index},
		dataType: "html",
		success: function(response)
		{
			$('#email_calling').hide();
			$('#mailbox_container_div').removeClass("mailbox_load_opacity");
			$('#mail_loader_indicator').hide();
			$('#email_list_view').empty().append(response);
			
		}
		});

	}
	function draft_imap_mailbox_view(msgno, label, start, end, per_page, tot_sent_mail, first_index, second_index)
	{
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		$('#mail_loader_indicator').show();
		var emailid = $('#info_email').val();
		
		$.ajax({
		type: "POST",
		url: baseurl+'Mailbox/draft_imap_mailbox_view',
		type: "POST",
		data:{'emailid':emailid, 'msgno':msgno, 'label':label, 'start' : start, 'end' : end, 'per_page' : per_page, 'tot_mail_list_count' : tot_sent_mail, 'first_index' : first_index, 'second_index' : second_index},
		dataType: "html",
		success: function(response)
		{
			$('#email_calling').hide();
			$('#mailbox_container_div').removeClass("mailbox_load_opacity");
			$('#mail_loader_indicator').hide();
			$('#email_list_view').empty().append(response);
			
		}
		});

	}

	function move_to_bin(emailid, uid, l_id)
	{
		$('#bin_uid').val(uid);
		$('#bin_email_id').val(emailid);
		$('#bin_email_list_last_id').val(l_id);
		$('#move_to_bin_modal').modal('show');
	}
	function confirmed_move_to_bin()
	{	
		$('#move_to_bin_yes_btn').prop('disabled', true);
		var uid = $('#bin_uid').val();
		var emailid = $('#bin_email_id').val();
		var l_id = $('#bin_email_list_last_id').val();
		$.ajax({
			type: "POST",
			url: baseurl+'Mailbox/move_to_bin',
			type: "POST",
			data:{'emailid':emailid, 'uid':uid},
			dataType: "html",
			success: function(response)
			{
				$('#move_to_bin_yes_btn').prop('disabled', false);
				if (response == '1') {
					$('#move_to_bin_modal').modal('toggle');
					$('#mailbox_email_list_'+l_id).hide('slow', function(){ $('#mailbox_email_list_'+l_id).remove(); });
				}
				else 
				{
					$('#move_to_bin_modal').modal('toggle');
					$('#mailbox_email_list_'+l_id).css("background-color", "#ffd8d8");
				}
				// $('#email_calling').hide();
				// $('#mailbox_container_div').removeClass("mailbox_load_opacity");
				// $('#mail_loader_indicator').hide();
				// $('#email_list_view').empty().append(response);
				
			}
		});
	}

	function search_get_another_part_of_list(search_arr,start,end,per_page)
	{
		var emailid = $('#info_email').val();
		var search_for_flag = $('#search_for_flag').val();
		var search_criteria = $('#search_criteria').val();
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		$('#mail_loader_indicator').show();

		$.ajax({
			type: "POST",
			url: baseurl+'Mailbox/get_another_part_of_search',
			type: "POST",
			data:{'emailid':emailid, 'search_for_flag':search_for_flag, 'search_arr' : search_arr, 'start' : start, 'end' : end, 'per_page' : per_page,'search_criteria':search_criteria},
			dataType: "html",
			success: function(response)
			{
				$('#email_calling').hide();
				$('#mailbox_container_div').removeClass("mailbox_load_opacity");
				$('#mail_loader_indicator').hide();
				$('#email_list_view').empty().append(response);	
				// $('#email_calling').hide();
				// $('#mailbox_container_div').removeClass("mailbox_load_opacity");
				// $('#mail_loader_indicator').hide();
				// $('#email_list_view').empty().append(response);
				
			}
		});
	}
</script>