<?php $this->load->view('common_header'); ?>



 

   <style type="text/css">

   .tag {

   display: inline-block;

  

  width: auto;

   height: 38px;

   

   background-color: #ffd24d;

   -webkit-border-radius: 3px 4px 4px 3px;

   -moz-border-radius: 3px 4px 4px 3px;

   border-radius: 3px 4px 4px 3px;

   

   border-left: 1px solid #ffd24d;



   /* This makes room for the triangle */

   margin-left: 19px;

   

   position: relative;

   

   color: #39474E;

   font-weight: 300;

   font-family: 'Source Sans Pro', sans-serif;

   font-size: 18px;

   line-height: 38px;



   padding: 0 10px 0 10px;

}



/* Makes the triangle */

.tag:before {

   content: "";

   position: absolute;

   display: block;

   right: -17px;

   width: 0;

   height: 0;

   border-top: 19px solid transparent;

   border-bottom: 19px solid transparent;

   border-left: 19px solid #ffd24d;

}



/* Makes the circle */

.tag:after {

   content: "";

   background-color: white;

   border-radius: 50%;

   width: 4px;

   height: 4px;

   display: block;

   position: absolute;

   left: -9px;

   top: 17px;

}



.tag_fup {

   display: inline-block;

  

  width: auto;

   height: 22px;

   

   background-color: #ffd24d;

  /* -webkit-border-radius: 3px 4px 4px 3px;

   -moz-border-radius: 3px 4px 4px 3px;*/

   border-radius: 3px 4px 4px 3px;

   

   border-left: 1px solid #ffd24d;



   /* This makes room for the triangle */

   /*margin-left: 19px;*/

   

   position: relative;

   

   color: #39474E;

   font-weight: 300;

  /* font-family: 'Source Sans Pro', sans-serif;

   font-size: 12px;*/

   line-height: 23px;



   /*padding: 0 10px 0 10px;*/

   padding: 0 0 0 0;

}



/* Makes the triangle */

.tag_fup:before {

   content: "";

   position: absolute;

   display: block;

   right: -17px;

   width: 0;

   height: 0;

   border-top: 12px solid transparent;

   border-bottom: 12px solid transparent;

   border-left: 19px solid #ffd24d;

}



/* Makes the circle */

.tag_fup:after {

   content: "";

   background-color: white;

   border-radius: 50%;

   width: 4px;

   height: 4px;

   display: block;

   position: absolute;

   left: -9px;

   top: 17px;

}

table.table p {

       /*display: none;*/

       visibility: hidden;margin-bottom: 0;

      }

table.table tr:hover p {

      /* display: block;*/

      visibility: visible;

}

.lead_table td{

    border-top: solid 1px #ebebeb;

    border-spacing:none;

    cellpadding: 0;

    cellspacing: 0;

    color: #3D3D3D;

    padding: 0px 4px 0px 4px;

    margin-left: 3px !important; 



}

.lead_table td .contact_info{

    white-space: nowrap;

    overflow:hidden;

    text-overflow:ellipsis;

    min-width:47px;

}

.breadcrumb_fonts {

   font-size: 12px !important;

}

.m-portlet .m-portlet__body {

    padding: 0.2rem 2.2rem !important;

}

.tr_size{

   height: 10px !important;

}

.m-subheader {

    padding: 0px 15px 0 15px;

}

.m-body .m-content {

    padding: 0px 15px;

}

.btn.m-btn--custom {

    padding: 5px 12px !important;

}

.m-portlet .m-portlet__head {

    height: 43px !important;

}

.lead_modi_info {

   padding: 1px !important;

}

/*.td_bold_font {

   font-size : 6px;

}*/

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

                                 <span class="m-nav__link-text">Vendor</span>

                              </a>

                           </li>

                           <li class="m-nav__separator">-</li>

                           <li class="m-nav__item">

                              <a href="<?php echo base_url(); ?>vendor" class="m-nav__link">

                                 <span class="m-nav__link-text">Vendor List</span>

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

                                       Vendor List

                                    </h3>

                                 </div>

                              </div>

                              <div class="m-portlet__head-tools">

                                 <ul class="m-portlet__nav">

                                    <li class="m-portlet__nav-item">

                                       <a href="javascript:;" id="tog_filter">

                                          <span>

                                             <i class="fa fa-filter"></i>

                                             <span></span>

                                          </span>

                                       </a>

                                    </li>

                                    <?php if($_SESSION['VendorAdd']==1){ ?>

                                    <li class="m-portlet__nav-item">

                                       <a href="<?php echo base_url(); ?>vendor/vendor_add" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">

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

                                 Vendor has activated successfully.

                              </div>



                              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">

                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                 </button>

                                 Vendor has deactivated successfully.

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











                              <form method="POST" action="<?php echo base_url();?>vendor">

                                 <div class="my_filter" style="display: none;"> 

                                    <div class="row">

                                       <div class="col-lg-2">

                                          <div class="form-group m-form__group">

                                             <label>Category</label>

                                             <select class="form-control selectpicker" data-live-search="true" id="category_id" name="category_id" onchange="submit_vendor_filter('filter');">

                                                <option value="">All Category</option>

                                                <?php

                                                   if(!empty($vendor_category_list))

                                                   {

                                                      foreach ($vendor_category_list as $vflist) { ?>

                                                         <option value="<?php echo $vflist['vendor_category_id']; ?>" <?php if($f_l_category == $vflist['vendor_category_id']){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $vflist['vendor_category']; ?></option>



                                                      <?php  } 

                                                   }

                                                ?>

                                             </select>

                                          </div>

                                       </div>

                                       <div class="col-lg-2">

                                          <div class="form-group m-form__group">

                                             <label>Type</label>

                                             <select class="form-control selectpicker" data-live-search="true" id="type_id" name="type_id" onchange="submit_vendor_filter('filter');">

                                                <option value="">All Type</option>

                                                <?php

                                                   if(!empty($vendor_type_list))

                                                   {

                                                      foreach ($vendor_type_list as $vflist) 

                                                      {?>



                                                         <option value="<?php echo $vflist['vendor_type_id']; ?>" <?php if($f_l_type == $vflist['vendor_type_id']){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $vflist['vendor_type']; ?></option>



                                                      <?php } 

                                                   }

                                                ?>

                                             </select>

                                          </div>

                                       </div>

                                       <div class="col-lg-2">

                                          <div class="form-group m-form__group">

                                             <label>Status</label>

                                             <select class="form-control selectpicker" data-live-search="true" id="vendor_st_filt" name="vendor_st_filt" onchange="submit_vendor_filter('filter');">

                                                <option value="">All Status</option>
                                                <option <?php echo ($f_v_st == '0') ? 'selected' : ''; ?> value="0">Active</option>
                                                <option <?php echo ($f_v_st == '1') ? 'selected' : ''; ?> value="1">In-Active</option>
                                             </select>

                                          </div>

                                       </div>
                                    </div>

                                 </div>

                              </form>



                              <!--begin: Datatable -->

                              <div class="row" id="vendor_list_table_append_block" style="display: none;"> 
                                 
                              </div>
                              <div class="row" id="vendor_list_table_append_block_loader"> 
                                 <div class="col-lg-5"></div>
                                 <div class="col-lg-2">
                                    <img src="<?php echo base_url(); ?>assets/demo/demo12/media/img/logo/aero_world2.gif" height="100px" width="100px" style="margin-top: 93px;">
                                 </div>
                                 <div class="col-lg-5"></div>
                              </div>

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

   <div class="modal fade" id="vendor_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      

   </div>

</div>

   

<script type="text/javascript">

var baseurl = '<?php echo base_url(); ?>';

var title = $('title').text() + ' | ' + 'Vendor List';

$(document).attr("title", title);





   $('#tog_filter').click(function(){

  $('.my_filter').slideToggle('slow'); 

});



function vendor_delete(val){

   $.ajax({

      type: "POST",

      url: baseurl+'vendor/vendor_delete',

      async: false,

      type: "POST",

      data: "id="+val,

      dataType: "html",

      success: function(response)

      {

         $('#vendor_delete').empty().append(response);

      }

   });

}

var pagecount = '';
var current_pagination_index = '';
function paginate_page(page,l_id)
{  
   current_pagination_index = l_id;
   pagecount = page;
   submit_vendor_filter('pagination');
}

var search_val = '';
function search_on_list(val)
{
   // if (val != '') {
    search_val = val;
    submit_vendor_filter('search');
   // }
}

submit_vendor_filter('filter');
function submit_vendor_filter(diff) {
   if(diff=='pagination') {
      current_pagination_index = current_pagination_index;
   }
   else{
      current_pagination_index = 1;
   }
   if (diff == 'search' || diff == 'perpage_count') {
      pagecount = 0;
   }
   else {
      pagecount = pagecount;
   }
   var perpage = $('#perpage').val();
   // var pagecount = localStorage.getItem('curr_page');
   $('#vendor_list_table_append_block_loader').show();
   $('#vendor_list_table_append_block').hide();
   var category_id = $('#category_id').val();
   // var product_id = $('#product_id').val();
   var type_id = $('#type_id').val();
   var vendor_st_filt = $('#vendor_st_filt').val();
   
   // var active_tab = "<?php // echo (isset($_GET['active_tab'])) ? '?active_tab='.$_GET['active_tab'] : ''; ?>";
  
   $.ajax({
      url:baseurl+'vendor/vendor_list_by_filter',
      type:'POST',
      data:{'category_id':category_id,'type_id':type_id,'vendor_st_filt':vendor_st_filt, 'pagecount' : pagecount, 'search_val' : search_val, 'current_pagination_index' : current_pagination_index,'perpage':perpage},
      dataType: 'html',
      success:function(result){
         $('#vendor_list_table_append_block').empty().append(result);
         $('#vendor_list_table_append_block_loader').hide();
         $('#vendor_list_table_append_block').show();
      }
   });
}

function removeVendor(val)

{ 

   $.ajax({

      type: "POST",

      url: baseurl+'vendor/delete',

      async: false,

      data:"field="+val,

      success: function(response)

      {

         window.location.href = baseurl+'vendor';

      }

   });

}



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

      url:baseurl+'vendor/vendor_change_status',

      data:datastring,

      cache: false,

      dataType: "html",

      success: function(result){ 

        if(unactive == 0){

            $('#active_success').show();

            $('#inactive_success').hide();

            setTimeout(function() {

            window.location = baseurl+"vendor";

         }, 3000);

        }else{

            $('#active_success').hide();

            $('#inactive_success').show();

            setTimeout(function() {

         window.location = baseurl+"vendor";

         }, 3000);

        }

       } 

   });

}

</script>

</body>

   <!-- end::Body -->

</html>