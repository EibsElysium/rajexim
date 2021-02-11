<?php $this->load->view('common_header'); ?>

            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="<?php echo base_url(); ?>Dashboard" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon fa fa-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Settings</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>addresstype" class="m-nav__link">
                                 <span class="m-nav__link-text">Address Type</span>
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
                                       Address Type List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['Address TypeAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_address_type">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Address Type</span>
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
                                    <th>Address Type</th>
                                    <th>Status</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($addresstype_list))
                                    {
                                       $i = 1;
                                       foreach ($addresstype_list as $e_list) 
                                       { 
                                          ?>
                                          <tr>
                                             <td>
                                                <h5 class="text-black"><?php echo $e_list['address_type']; ?></h5>   
                                             </td>
                                             <td>
                                                <span class="m-switch m-switch--sm m-switch--success" data-toggle="m-tooltip" data-placement="top"  title=<?php if($e_list['status']==0){echo "Active";} else{echo "Inactive";} ?>>
                                                <label>
                                                   <input type="checkbox" <?php if($e_list['status']==0){echo "checked";} ?> id="activeunactive_<?php echo $i;?>"  name="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $e_list['address_type_id']; ?>,<?php echo $i; ?>)" value="<?php echo $e_list['status'];?>"  data-plugin="switchery" data-color="#3f3e6a" data-size="small">
                                                   <span></span>
                                                   <span id="statusprint" style="display:none"><?php if($e_list['status']==0){echo 'Active';}else{echo 'Inactive';} ?></span>
                                                </label>
                                                </span>  
                                             </td>
                                             <td>
                                                   <?php if($_SESSION['Address TypeEdit']==1){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#addresstype_edit" onclick="return addresstype_edit(<?php echo $e_list['address_type_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                                   <?php }?>
                                                   <?php if($_SESSION['Address TypeDelete']==1){ ?>                                              
                                                      <a href="javascript:;" data-toggle="modal" data-target="#addresstype_delete" onclick="return addresstype_delete(<?php echo $e_list['address_type_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a>
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
   <div class="modal fade" id="create_address_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Address Type</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>addresstype/create_addresstype" onsubmit="return addresstype_validation()">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Address Type<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="address_type" name="address_type" placeholder="Enter Address Type" onkeyup="checkAddresstypeUnique(this.value);">
                           <span id="address_type_err" class="text-danger"></span>
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
   <div class="modal fade" id="addresstype_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<!-- Drop Lead-->
<div class="container">
   <div class="modal fade" id="addresstype_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Address Type List';
$(document).attr("title", title); 




var cno=0;
function checkAddresstypeUnique(val)
{
    //var baseurl= $("#baseUrl").val();
    if(val!='')
    {
       $.ajax({
         type:"POST",
         url:baseurl+'addresstype/checkAddresstypeUnique',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
               
               if(result>0)
               {
                   $('#address_type_err').html('Address Type Already Exist!');
                   cno++;
               }
               else
               {
                   $('#address_type_err').html('');
                   cno=0;
               }

         }
         });
   }
}

function addresstype_validation()
{
   var err = 0;
   var addresstype = $('#address_type').val();

   if(addresstype==''){
      $('#address_type_err').html('Address Type is required!');
      err++;
   }
   else
   {
      if(cno>0)
      {
         $('#address_type_err').html('Address Type Already Exist!');
         err++;
      }
      else
      {
         $('#address_type_err').html('');
      }
   }

   if(err>0){ return false; }else{ return true; }
}

function activeunactive(val,ival) {
            var unactive;
            var unactv;
            //var baseurl= $("#baseUrl").val();
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
               url:baseurl+'addresstype/addresstype_active',
               data:datastring,
               cache: false,
               dataType: "html",
               success: function(result){
                  // alert(result+unactive);
                  if(a == 1){
                        $("#active").css('display','block');
                     $("#active").addClass('response');
                    }else{
                        $("#deactive").css('display','block');
                     $("#deactive").addClass('response');
                    }      
                     setTimeout(function() {
                     window.location = baseurl+"addresstype";
                    }, 3000);
               },
               error: function (error) {
                  alert('error; ' + eval(error));
                  setTimeout(function() {
                     window.location = baseurl+"addresstype";
                    }, 3000);
               }
            });
         }

function addresstype_edit(val){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'addresstype/addresstype_edit',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#addresstype_edit').empty().append(response);
}
});
}   

var cnoe=0;
function checkAddresstypeUniqueEdit(val)
{
    //var baseurl= $("#baseUrl").val();
    var bid = $('#address_type_id').val();
    if(val!='')
    {
       $.ajax({
         type:"POST",
         url:baseurl+'addresstype/checkAddresstypeUniqueEdit',
         data:{'value':val,'bid':bid},
         cache: false,
         dataType: "html",
         success: function(result){
               
               if(result>0)
               {
                   $('#address_type_edit_err').html('Address Type Already Exist!');
                   cnoe++;
               }
               else
               {
                   $('#address_type_edit_err').html('');
                   cnoe=0;
               }

         }
         });
   }
}    

function addresstype_edit_validation()
{
   var err = 0;
   var brand = $('#address_type_edit').val();

   if(brand==''){
      $('#address_type_edit_err').html('Address Type is required!');
      err++;
   }
   else
   {
      if(cnoe>0)
      {
         $('#address_type_edit_err').html('Address Type Already Exist!');
         err++;
      }
      else
      {
         $('#address_type_edit_err').html('');
      }
   }

   if(err>0){ return false; }else{ return true; }
}  

function addresstype_delete(val){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'addresstype/addresstype_delete',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#addresstype_delete').empty().append(response);
}
});
}

function removeAddresstype(val)
{ 
//var baseurl= $("#baseUrl").val();
$.ajax({
type: "POST",
url: baseurl+'addresstype/delete',
async: false,
data:"field="+val,
success: function(response)
{
window.location.href = baseurl+'addresstype';
}
});
}



</script>
</body>
   <!-- end::Body -->
</html>