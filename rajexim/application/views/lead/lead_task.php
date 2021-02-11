<?php $this->load->view('common_header'); $date_format =common_date_format();?>

            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="#" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon fa fa-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>buyerorder" class="m-nav__link">
                                 <span class="m-nav__link-text">Lead</span>
                              </a>
                           </li>

                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Lead Task</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>

               <!-- END: Subheader -->
               <div class="m-content">
               <?php if($this->session->flashdata('purchase_success')){?>
               <div class="alert alert-success alert-dismissible response" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  </button>
                  <?php echo $this->session->flashdata('purchase_success'); ?>               
               </div>
               <?php } ?> 
               <?php if($this->session->flashdata('purchase_err')){?>
               <div class="alert alert-danger alert-dismissible response" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  </button>
                  <?php echo $this->session->flashdata('purchase_err'); ?>                
               </div>
               <?php } ?> 

                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Lead Task
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>leads" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-angle-double-left"></i>
                                             <span>Back</span>
                                          </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="POST" action="<?php echo base_url(); ?>leads/create_lead_task" onsubmit="return lead_task_validation();">
                           <div class="m-portlet__body">
                              <fieldset>
                                 <legend class="text-info"><b>Lead Info</b></legend>
                                    <div class="col-lg-12">
                                      <div class="row">
                                         <div class="col-lg-6">
                                            <label class="col-lg-4">Lead ID</label>
                                            <label class="col-lg-1">:</label>
                                            <p class="col-lg-7"><?php echo ($lead_details->lead_code) ? $lead_details->lead_code : '-'; ?></p>
                                         </div>
                                         <div class="col-lg-6">
                                            <label class="col-lg-4">Lead Name</label>
                                            <label class="col-lg-1">:</label>
                                            <p class="col-lg-7"><?php echo ($contact_book_info->lead_name) ? $contact_book_info->lead_name : '-'; ?></p>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-lg-6">
                                            <label class="col-lg-4">Company Name</label>
                                            <label class="col-lg-1">:</label>
                                            <p class="col-lg-7"><?php echo ($contact_book_info->company_name) ? $contact_book_info->company_name : '-'; ?></p>
                                         </div>
                                         <div class="col-lg-6">
                                            <label class="col-lg-4">Country</label>
                                            <label class="col-lg-1">:</label>
                                            <p class="col-lg-7"><?php echo ($contact_book_info->country_name) ? $contact_book_info->country_name : '-'; ?></p>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-lg-6">
                                            <label class="col-lg-4">Designation</label>
                                            <label class="col-lg-1">:</label>
                                            <p class="col-lg-7"><?php echo ($contact_book_info->designation) ? $contact_book_info->designation : '-'; ?></p>
                                         </div>
                                         <div class="col-lg-6">
                                            <label class="col-lg-4">Website</label>
                                            <label class="col-lg-1">:</label>
                                            <p class="col-lg-7"><?php echo ($contact_book_info->website) ? $contact_book_info->website : '-'; ?></p>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-lg-6">
                                            <label class="col-lg-4">Address</label>
                                            <label class="col-lg-1">:</label>
                                            <p class="col-lg-7"><?php echo ($contact_book_info->address) ? $contact_book_info->address : '-'; ?></p>
                                         </div>
                                      </div>  

                                   </div>
                                 </fieldset> 

                                 <?php if(count($lead_task_list)>0)
                                 {?>
                                 <fieldset>
                                     <legend class="text-info"><b>Task List</b></legend>
                                     <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme m_table_2">
                                       <thead>
                                          <tr>
                                             <th width="15%">Task Duration</th>
                                             <th width="30%">Task</th>
                                             <th width="15%">Assigned To</th>
                                             <th width="30%">Remarks</th>
                                             <th width="10%">Status</th>
                                             <th width="10%">Action</th>

                                          </tr>
                                       </thead>
                                       <tbody>
                                        <?php foreach($lead_task_list as $botlist){
                                          if($botlist['status']==0)
                                          {
                                            $sts = 'Not Started';
                                          }
                                          elseif($botlist['status']==1)
                                          {
                                            $sts = 'In Progress';
                                          }
                                          else
                                          {
                                            $sts = 'Completed';
                                          }
                                          ?>
                                        <tr>
                                          <td>
                                            <b><?php echo date('d-m-Y', strtotime($botlist['lead_task_date']));?> - <?php echo date('d-m-Y', strtotime($botlist['lead_task_end_date']));?></b>
                                          </td>
                                          <td>
                                            <?php echo $botlist['task'];?>
                                          </td>
                                          <td>
                                            <?php echo $botlist['name'];?>
                                          </td>
                                          <td>
                                            <?php echo $botlist['remarks'];?>
                                          </td>
                                          <td>
                                            <?php echo $sts;?>
                                          </td>
                                          <td>
                                            <?php if($login_id==$botlist['assigned_to'] || $_SESSION['admindata']['role_id']==1){?>
                                                <a href="javascript:;" data-toggle="modal" data-target="#bo_complete" onclick="return bo_complete(<?php echo $botlist['lead_task_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                                <?php }?>
                                                 <a href="javascript:;" data-toggle="modal" data-target="#bo_rem_complete" onclick="return bo_rem_complete(<?php echo $botlist['lead_task_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></span></a>
                                          </td>
                                        </tr>
                                        <?php }?>
                                       </tbody>
                                    </table>
                                   </fieldset>  
                                   <?php }?>  
                                   
                                   <fieldset>
                                     <input type="hidden" id="lead_id" name="lead_id" value="<?php echo $lead_details->lead_id;?>">
                                     <legend class="text-info"><b>Create Task</b></legend>
                                     <div id="mcontent10">
                                        <div class="row">
                                           <div class="col-lg-3">
                                              <label>Task Date<span class="text-danger">*</span></label>
                                              <input type="text" id="alter_lead_task_date" onblur="change_common_dateformat();" class="form-control m_datepicker_1" placeholder="Enter Task Date">
                                              <input type="hidden" id="lead_task_date" name="lead_task_date">
                                              <span id="lead_task_date_err" class="text-danger"></span>
                                           </div>
                                           <div class="col-lg-3">
                                              <label>Task<span class="text-danger">*</span></label>
                                              <textarea rows="3" id="task" name="task" class="form-control m-input"></textarea>
                                              <span id="task_err" class="text-danger"></span>
                                           </div>
                                           <div class="col-lg-3">
                                              <div class="form-group m-form__group">
                                                 <label>Assigned To<span class="text-danger">*</span></label>
                                                 <select class="custom-select form-control" id="assigned_to" name="assigned_to">
                                                   <option value="">Choose User</option>
                                                   <?php foreach($user_list as $ulist){?>
                                                    <option value="<?php echo $ulist['user_id'];?>"><?php echo $ulist['name'];?></option>
                                                    <?php }?>
                                                </select>
                                                 <span id="assigned_to_err" class="text-danger"></span>
                                              </div>
                                           </div>
                                           <div class="col-lg-3">
                                              <label>Task End Date<span class="text-danger">*</span></label>
                                              <input type="text" id="alter_lead_task_end_date" name="alter_lead_task_end_date" onblur="end_change_common_dateformat();" class="form-control m_datepicker_1" placeholder="Enter Task End Date">
                                              <input type="hidden" id="lead_task_end_date" name="lead_task_end_date">
                                              <span id="lead_task_end_date_err" class="text-danger"></span>
                                           </div>
                                        </div>
                                     </div>
                                  </fieldset>     
                              
                           </div>
                          <!--end: Form Body -->
                          <div class="m-portlet__foot">
                             <div class="row align-items-center">
                                <div class="col-lg-12 m--align-right">
                                   <button type="submit" id="add_wl_btn" class="btn btn-primary">Create</button>
                                </div>
                             </div>
                          </div>
                          <input type="hidden" id='baseurl' name="baseurl" value="<?php echo base_url();?>">
                          <input type="hidden" id='error' name="error" value="0">
                          <input type="hidden" id='visible_type' name="visible_type" value="hide">
                       </form>
                        </div>
                     </div>
                  </div>

                  <!--End::Section-->
               </div>
            </div>
         </div>

         <div class="container">
    <div class="modal fade" id="bo_complete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       
    </div>
   </div>

         <div class="container">
    <div class="modal fade" id="bo_rem_complete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       
    </div>
   </div>
         <!-- end:: Body -->

         <!-- begin::Footer -->
         <?php $this->load->view('common_footer'); ?>

         <!-- end::Footer -->
      </div>

      <!-- end:: Page -->




<script type="text/javascript">
 var baseurl = '<?php echo base_url(); ?>';
function bo_complete(val){
$.ajax({
type: "POST",
url: baseurl+'Leads/task_remarks',
async: false,
type: "POST",
data: "botid="+val,
dataType: "html",
success: function(response)
{
$('#bo_complete').empty().append(response);
}
});
}
function bo_rem_complete(val){
$.ajax({
type: "POST",
url: baseurl+'leads/task_remarks_list',
async: false,
type: "POST",
data: "botid="+val,
dataType: "html",
success: function(response)
{
$('#bo_rem_complete').empty().append(response);
}
});
}
  function change_common_dateformat()
  {
    var choosen_date = $('#alter_lead_task_date').val();
    $('#lead_task_date').val(choosen_date);
    $.ajax({
       url:baseurl+'Leads/change_dtrange_val',
       type:'POST',
       data:{'value':choosen_date},
       dataType: 'html',
       success:function(result){
          $('#alter_lead_task_date').val(result);
       }
    });
  }
  function end_change_common_dateformat()
  {
    var choosen_date = $('#alter_lead_task_end_date').val();
    $('#lead_task_end_date').val(choosen_date);
    $.ajax({
       url:baseurl+'Leads/change_dtrange_val',
       type:'POST',
       data:{'value':choosen_date},
       dataType: 'html',
       success:function(result){
          $('#alter_lead_task_end_date').val(result);
       }
    });
  }
  var notification_content_comment = '';
  function lead_notification_message_generation()
  {
    var assigned_to = $('#assigned_to').val();
    var task = $('#task').val();
    var lead_id = <?php echo $lead_id; ?>;
    var created_by = '<?php echo $_SESSION['admindata']['user_id']; ?>';
    
    $.ajax({
        type: "POST",
        url:baseurl+'Leads/generate_buyer_task_comment_notification_content',
        data:{'task':task,'created_by':created_by,'assigned_to':assigned_to,'lead_id':lead_id},
        async: false,
        dataType: "html",
        success: function(result){
           notification_content_comment = result;
        }
     });

  }
   function lead_task_validation(){
    lead_notification_message_generation();
    var err = 0;
      var botdate = $('#lead_task_date').val();
      var task = $('#task').val();
      var ato = $('#assigned_to').val();
      var botedate = $('#lead_task_end_date').val();
      
      if(botdate==''){
         $('#lead_task_date_err').html('Choose Task Date!');
         err++;
      }else{
        $('#lead_task_date_err').html('');
      }
      if(task==''){
         $('#task_err').html('Enter Task!');
         err++;
      }else{
        $('#task_err').html('');
      }
      if(ato==''){
         $('#assigned_to_err').html('Choose User!');
         err++;
      }else{
        $('#assigned_to_err').html('');
      }
      if(botedate==''){
         $('#lead_task_end_date_err').html('Choose Task End Date!');
         err++;
      }else{
        $('#lead_task_end_date_err').html('');
      }


  if(err>0){ 
    return false;
  }
  else{ 
    
    var conn = new WebSocket('ws://localhost:8282');
    var client = {
     user_id: <?php echo $_SESSION['admindata']['user_id']; ?>,
     recipient_id: null,
     type: 'socket',
     token: null,
     message: null
    };

    conn.onopen = function (e) {
     conn.send(JSON.stringify(client));
     // $('#messages').append('<font color="green">Successfully connected as user ' + client.user_id + '</font><br>');
     console.log(client.user_id);
    };

    conn.onmessage = function (e) {
     var data = JSON.parse(e.data);
     if (data.message) {
         $('.noti_li').append(data.message);
         console.log(data.user_id + ' : ' + data.message);
     }
     if (data.type === 'token') {
         // $('#token').html('JWT Token : ' + data.token);
         console.log('JWT Token : ' + data.token);
     }
    };

    client.message = notification_content_comment;
    client.token = $('#token').text().split(': ')[1];
    client.type = 'chat';
    if ($('#assigned_to').val() != '') {
     client.recipient_id = $('#assigned_to').val();
    }
    conn.send(JSON.stringify(client));
    return true; 
  }
}    
</script>

   </body>

   <!-- end::Body -->
</html>