<?php $this->load->view('common_header'); ?>
<style>
   span.lead_source_color {
       border: 1px solid #aaa;
       padding: 1px 11px;
       margin-left: 2%;
       border-radius: 50px;
   }
</style>
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
                  <span class="m-nav__link-text">Value Variant</span>
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
                           Value Variant
                        </h3>
                     </div>
                  </div>
                  <div class="m-portlet__head-tools">
                     <ul class="m-portlet__nav">
                        <?php //if($_SESSION['Value VariantAdd']==1){ ?>
                        <!-- <li class="m-portlet__nav-item">
                           <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_top">
                           <span>
                           <i class="la la-plus"></i>
                           <span>Create</span>
                           </span>
                           </a>
                        </li> -->
                        <?php //} ?>
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
                     Value Variant has activated successfully.
                  </div>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     Value Variant has deactivated successfully.
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
                           <th>From Amount</th>
                           <th>To Amount</th>
                           <th>Color</th>
                           <th>Status</th>
                           <th class="notexport" data-orderable="false">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           if(!empty($get_all_vv))
                           
                           {
                           
                              $i = 1;
                           
                              foreach ($get_all_vv as $vv_info) 
                           
                              { ?>
                        <tr>
                           <td>
                              <?php echo $vv_info['vv_from_amount']; ?>   
                           </td>
                           <td>
                              <?php echo $vv_info['vv_to_amount']; ?>   
                           </td>
                           <td>
                              <span class="lead_source_color" style="background-color: <?php echo $vv_info['vv_color']; ?>;"></span>
                           </td>
                           <td>
                              <span class="m-switch m-switch--sm m-switch--success"  data-toggle="m-tooltip" data-placement="top" title="<?php if($vv_info['status']==0){ echo 'Active'; }else{ echo 'In Active'; } ?>">
                              <label>
                              <input type="checkbox" <?php if($vv_info['status']==0){ echo "checked";} ?> name="activeunactive_<?php echo $i;?>" id="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $vv_info['vv_id']; ?>,<?php echo $i; ?>)" value="<?php echo $vv_info['status'];?>">
                              <span></span>
                              </label>
                              </span>
                           </td>
                           <td>
                              <?php if($_SESSION['Value VariantEdit']==1){ ?>
                              <a href="javascript:;" onclick="vv_edit(<?php echo $vv_info['vv_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                              <?php } ?>
                              <?php // if($_SESSION['Terms of PaymentDelete']==1){ ?>                                              
                              <!-- <a href="javascript:;" data-toggle="modal" data-target="#top_delete" onclick="return top_delete(<?php // echo $vv_info['vv_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a> -->
                              <?php //} ?>
                           </td>
                        </tr>
                        <?php $i++; } 
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

<!-- Update exporter-->
<div class="container">
   <div class="modal fade" id="vv_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   </div>
</div>
<!-- Drop Lead-->

<script type="text/javascript">
   var baseurl = '<?php echo base_url(); ?>';
   
   var title = $('title').text() + ' | ' + 'Interest List';
   
   $(document).attr("title", title); 
   
   
   
   // To check exporter name is unique
   
   var expo = 0;
   
   function checkUniquetopName()
   
   {
   
      var val = $('#top_name').val();
   
      $.ajax({
   
         type:"POST",
   
         url:baseurl+'Terms_of_payment/checkUniquetopName',
   
         data:{'value':val},
   
         cache: false,
   
         dataType: "html",
   
         success: function(result){
   
            if(result>0)
   
            {
   
               $('#top_name_err').html('Terms of payment Name already exists!');
   
               $('#btnSubmit').prop('disabled', true);
   
               expo = 1;
   
            }
   
            else
   
            {
   
               $('#top_name_err').html('');
   
               $('#btnSubmit').prop('disabled', false);
   
               expo = 0;
   
            }
   
         }
   
      });
   
   }
   
   
   
   
   
    // To validate lead Status add form
   
   function create_top_validataion()
   
   {
   
      var err = 0;
   
      var name = $('#top_name').val();
   
      var txt = $('#top_text').val();
   
      var type = $('#top_type').val();
   
      if(name == '')
   
      {
   
         $('#top_name_err').html('Terms of payment Name is required!');
   
         err++;
   
      }else{
   
         if(expo == 1)
   
         {
   
            $('#top_name_err').html('Terms of payment Name already exists!');
   
            err++;
   
         }
   
         else
   
         {
   
            $('#top_name_err').html('');
   
         }
   
      }
   
      if (txt.trim() == '') {
   
         $('#top_text_err').html('Terms of payment Text is required!');
   
         err++;
   
      }
   
      else {
   
         $('#top_text_err').html('');
   
      }
   
      if (type == '') {
   
         $('#top_type_err').html('Terms of payment Type is required!');
   
         err++;
   
      }
   
      else {
   
         $('#top_type_err').html('');
   
      }
   
      if(err> 0){ return false;}else{ return true; }   
   
   }
   
   
   
   // To edit exporter
   
   function vv_edit(val)
   
   {
   
      $.ajax({
   
      type: "POST",
   
      url: baseurl+'Settings/vv_edit',
   
      async: false,
   
      data: "value="+val,
   
      dataType: "html",
   
      success: function(response)
   
      {
   
      $('#vv_edit').empty().append(response);
      $('#vv_edit').modal('show');
   
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
   
         url:baseurl+'Settings/vv_change_status',
   
         data:datastring,
   
         cache: false,
   
         dataType: "html",
   
         success: function(result){ 
   
           if(unactive == 0){
   
               $('#active_success').show();
   
               $('#inactive_success').hide();
   
               setTimeout(function() {
   
               window.location = baseurl+"Settings/value_variant";
   
            }, 3000);
   
           }else{
   
               $('#active_success').hide();
   
               $('#inactive_success').show();
   
               setTimeout(function() {
   
            window.location = baseurl+"Settings/value_variant";
   
            }, 3000);
   
           }
   
          } 
   
      });
   
   }
   
   // To delete exporter
   
   
   
   
   
   function top_delete(val){
   
      $('#del_terms_of_payment_id').empty().val(val);
   
      $('#top_delete').modal('show');
   
   }
   
   
   
   
   
</script>
</body>
<!-- end::Body -->
</html>