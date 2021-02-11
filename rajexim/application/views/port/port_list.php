<?php $this->load->view('common_header'); ?>

            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="<?php echo base_url(); ?>Dashboard" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon la la-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Settings</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Proforma Invoice</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>port" class="m-nav__link">
                                 <span class="m-nav__link-text">Port</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>

               <!-- END: Subheader -->
               <div class="m-content">
                  
                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Port List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['PortAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_port">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create</span>
                                          </span>
                                       </a>
                                    </li>
                                    <?php }?>

                              <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                 <a href="javascript:;" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                    Export
                                 </a>
                                 <div class="m-dropdown__wrapper" style="z-index: 101;">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 36px;"></span>
                                    <div class="m-dropdown__inner">
                                       <div class="m-dropdown__body">
                                          <div class="m-dropdown__content">
                                             <ul class="m-nav">
                                                <!-- <li class="m-nav__section m-nav__section--first">
                                                   <span class="m-nav__section-text">Export Tools</span>
                                                </li> -->
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_print">
                                                      <i class="m-nav__link-icon la la-print"></i>
                                                      <span class="m-nav__link-text">Print</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_copy">
                                                      <i class="m-nav__link-icon la la-copy"></i>
                                                      <span class="m-nav__link-text">Copy</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_excel">
                                                      <i class="m-nav__link-icon la la-file-excel-o"></i>
                                                      <span class="m-nav__link-text">Excel</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_csv">
                                                      <i class="m-nav__link-icon la la-file-text-o"></i>
                                                      <span class="m-nav__link-text">CSV</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_pdf">
                                                      <i class="m-nav__link-icon la la-file-pdf-o"></i>
                                                      <span class="m-nav__link-text">PDF</span>
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <div class="alert alert-success alert-dismissible fade show" role="alert" id="active_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Port has activated successfully.
                              </div>

                              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Port has deactivated successfully.
                              </div>

                              <?php if($this->session->flashdata('qstage_success')){?>
                                   <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('qstage_success'); ?>
                                 </div>
                                 <?php } ?>

                              <?php if($this->session->flashdata('qstage_err')){?>
                                      <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('qstage_err'); ?>
                                 </div>
                                 <?php } ?>  
                              <!--begin: Datatable -->
                           <table class="table table-striped table-bordered  table-checkable" id="m_table_2">
                              <thead>
                                 <tr>
                                    <th>Vessel Flight</th>
                                    <th>Port Name</th>
                                    <th>Port City</th>
                                    <th>Port Country</th>
                                    <th>Status</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($port_list))
                                    {
                                       $i = 1;
                                       foreach ($port_list as $e_list) 
                                       { ?>
                                          <tr>
                                             <td>
                                                <?php echo $e_list['vessel_flight_name']; ?>   
                                             </td>
                                             <td>
                                                <?php echo $e_list['port_name']; ?>   
                                             </td>
                                             <td>
                                                <?php echo $e_list['port_city']; ?>   
                                             </td>
                                             <td>
                                                <?php echo $e_list['port_country']; ?>   
                                             </td>
                                             <td>
                                                <span class="m-switch m-switch--sm m-switch--success"  data-toggle="m-tooltip" data-placement="top" title="<?php if($e_list['status']==0){ echo 'Active'; }else{ echo 'In Active'; } ?>">
                                                <label>
                                                   <input type="checkbox" <?php if($e_list['status']==0){ echo "checked";} ?> name="activeunactive_<?php echo $i;?>" id="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $e_list['port_id']; ?>,<?php echo $i; ?>)" value="<?php echo $e_list['status'];?>">
                                                   <span></span>
                                                </label>
                                                </span>
                                             </td>
                                             <td>
                                                   <?php if($_SESSION['PortEdit']==1){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#port_edit" onclick="return port_edit(<?php echo $e_list['port_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                                   <?php }?>
                                                   <?php if($_SESSION['PortDelete']==1){ ?>                                              
                                                   <a href="javascript:;" data-toggle="modal" data-target="#port_delete" onclick="return port_delete(<?php echo $e_list['port_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a>
                                                   <?php }?>
                                                
                                             </td>
                                          </tr>
                                          
                                    <?php   $i++; }
                                    } ?>
                              </tbody>
                           </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--End::Section-->
               </div>
            </div>
         </div>

         <!-- end:: Body -->

         <!-- begin::Footer -->
         <?php $this->load->view('common_footer'); ?>
         <!-- end::Footer -->
      </div>
      <!-- end:: Page -->

      <!-- end::Scroll Top -->
      <!--begin::Modal-->
      <!-- Create Lead Status-->
<div class="container">
   <div class="modal fade" id="create_port" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create Port</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>port/create_port" onsubmit="return port_validation()">
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="row">                        
                              <div class="col-lg-12">
                                 <div class="form-group m-form__group">
                                    <label>Vessel / Flight<span class="text-danger">*</span></label>
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="vessel_flight_id" id="vessel_flight_id"> 
                                       <option value="">Choose Vessel/Flight</option>
                                       <?php
                                          if(!empty($vessel_flight_list))
                                          {
                                             foreach ($vessel_flight_list as $vflist) { ?>
                                                <option value="<?php echo $vflist['vessel_flight_id']; ?>"><?php echo $vflist['vessel_flight_name']; ?></option>
                                             <?php }
                                          }
                                       ?>
                                    </select>
                                    <span class="text-danger" id="vessel_flight_id_err"></span>
                                 </div>
                              </div>
                           </div>

                           <div class="row">                        
                              <div class="col-lg-12">
                                 <div class="form-group m-form__group">
                                    <label>Port Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Port Name" name="port_name" id="port_name" onkeyup="checkUniquePort();">
                                    <span id="port_name_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>

                           <div class="row">                        
                              <div class="col-lg-12">
                                 <div class="form-group m-form__group">
                                    <label>Port City<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Port City" name="port_city" id="port_city">
                                    <span id="port_city_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>

                           <div class="row">                        
                              <div class="col-lg-12">
                                 <div class="form-group m-form__group">
                                    <label>Port Country<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Port Country" name="port_country" id="port_country">
                                    <span id="port_country_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" id="btnSubmit" class="btn btn-primary">Create</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
               </form>
            </div>
      </div>
   </div>
</div>

<!-- Update exporter-->
<div class="container">
   <div class="modal fade" id="port_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<!-- Drop Lead-->
<div class="container">
   <div class="modal fade" id="port_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Port List';
$(document).attr("title", title); 

// To check exporter name is unique
var expo = 0;
function checkUniquePort()
{
   var val = $('#port_name').val();
   $.ajax({
      type:"POST",
      url:baseurl+'port/checkUniquePort',
      data:{'value':val},
      cache: false,
      dataType: "html",
      success: function(result){
         if(result>0)
         {
            $('#port_name_err').html('Port already exists!');
            $('#btnSubmit').prop('disabled', true);
            expo = 1;
         }
         else
         {
            $('#port_name_err').html('');
            $('#btnSubmit').prop('disabled', false);
            expo = 0;
         }
      }
   });
}


 // To validate lead Status add form
function port_validation()
{
   var err = 0;
   var vfid = $('#vessel_flight_id').val();
   var pname = $('#port_name').val();
   var pcity = $('#port_city').val();
   var pctry = $('#port_country').val();

   if(vfid=='')
   {
      $('#vessel_flight_id_err').html('Vessel Flight is required!');
      err++;
   }
   else
   {
      $('#vessel_flight_id_err').html('');
   }

   if(pname == '')
   {
      $('#port_name_err').html('Port Name is required!');
      err++;
   }else{
      if(expo == 1)
      {
         $('#port_name_err').html('Port already exists!');
         err++;
      }
      else
      {
         $('#port_name_err').html('');
      }
   }

   if(pcity=='')
   {
      $('#port_city_err').html('Port City is required!');
      err++;
   }
   else
   {
      $('#port_city_err').html('');
   }

   if(pctry=='')
   {
      $('#port_country_err').html('Port Country is required!');
      err++;
   }
   else
   {
      $('#port_country_err').html('');
   }
   
   if(err> 0){ return false;}else{ return true; }   
}

// To edit exporter
function port_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'port/port_edit',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#port_edit').empty().append(response);
   }
   });
}

// To change active status
function activeunactive(val,ival) {

   var unactive;
   var unactv;
   var a = $("#activeunactive_"+ival).val();
   if(a==1) {
      unactive=0;
      unactv="Active"
   }
   else{
      unactive=1;
      unactv="In-Active"
   }
   
   var datastring="id="+val+"&status="+unactive;
   $.ajax({
      type:"POST",
      url:baseurl+'port/port_change_status',
      data:datastring,
      cache: false,
      dataType: "html",
      success: function(result){ 
        if(unactive == 0){
            $('#active_success').show();
            $('#inactive_success').hide();
            setTimeout(function() {
            window.location = baseurl+"port";
         }, 3000);
        }else{
            $('#active_success').hide();
            $('#inactive_success').show();
            setTimeout(function() {
         window.location = baseurl+"port";
         }, 3000);
        }
       } 
   });
}
// To delete exporter


function port_delete(val){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'port/port_delete',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#port_delete').empty().append(response);
}
});
}

function removePort(val)
{ 
//var baseurl= $("#baseUrl").val();
$.ajax({
type: "POST",
url: baseurl+'port/delete',
async: false,
data:"field="+val,
success: function(response)
{
window.location.href = baseurl+'port';
}
});
}



</script>
</body>
   <!-- end::Body -->
</html>