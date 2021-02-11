<?php $this->load->view('common_header'); ?>
	<style>
   .container {
          max-width: 587px;
   }  
   .tar_count {
      width: 31%;
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
											<i class="m-nav__link-icon fa fa-home"></i>
										</a>
									</li>
									<li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>Targets" class="m-nav__link">
                                 <span class="m-nav__link-text">Targets</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>Targets" class="m-nav__link">
                                 <span class="m-nav__link-text">Target List</span>
                              </a>
                           </li>
								</ul>
							</div>
						</div>
					</div>

					<!-- END: Subheader -->
					<div class="m-content">
                  <div class="alert alert-success alert-dismissible" style="display:none;" id="active" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     Target has been activated successfully
                  </div>
                        <div class="alert alert-success alert-dismissible" style="display:none;" id="deactive" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     Target has been deactivated successfully
                  </div>

                  <?php if($this->session->flashdata('target_success')){?>
                     <div class="alert alert-success alert-dismissible response" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                        <?php echo $this->session->flashdata('target_success'); ?>              
                     </div>
                  <?php } if($this->session->flashdata('target_err')){?>
                     <div class="alert alert-success alert-dismissible response" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                        <?php echo $this->session->flashdata('target_err'); ?>                  
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
                                       Target
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                       <form action="<?php echo base_url(); ?>Targets" method="POST" id="target_filter">
                                          <div class="form-group m-form__group">
                                             <input type="text" class="form-control finance_year" placeholder="Enter Year" name="target_year" id="target_year"  onchange="submit_target_form('filter');" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>">
                                          </div>
                                       </form>
                                    </li>
                                    <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                       <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
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
                                                         <a href="#" class="m-nav__link" id="export_print">
                                                            <i class="m-nav__link-icon la la-print"></i>
                                                            <span class="m-nav__link-text">Print</span>
                                                         </a>
                                                      </li>
                                                      <li class="m-nav__item">
                                                         <a href="#" class="m-nav__link" id="export_copy">
                                                            <i class="m-nav__link-icon la la-copy"></i>
                                                            <span class="m-nav__link-text">Copy</span>
                                                         </a>
                                                      </li>
                                                      <li class="m-nav__item">
                                                         <a href="#" class="m-nav__link" id="export_excel">
                                                            <i class="m-nav__link-icon la la-file-excel-o"></i>
                                                            <span class="m-nav__link-text">Excel</span>
                                                         </a>
                                                      </li>
                                                      <li class="m-nav__item">
                                                         <a href="#" class="m-nav__link" id="export_csv">
                                                            <i class="m-nav__link-icon la la-file-text-o"></i>
                                                            <span class="m-nav__link-text">CSV</span>
                                                         </a>
                                                      </li>
                                                      <li class="m-nav__item">
                                                         <a href="#" class="m-nav__link" id="export_pdf">
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
                              <div class="container">
                                 <!--begin: Datatable -->
                                 <div class="row" id="tar_list_table_append_block" style="display: none;"> 
                                 
                                   </div>
                                   <div class="row" id="tar_list_table_append_block_loader"> 
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
                  </div>

                  <!--End::Section-->
               </div>
				</div>
			</div>

			<!-- end:: Body -->

			<?php $this->load->view('common_footer'); ?>
<!--begin::Modal-->
<div class="container">
   <div class="modal fade" id="role_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <form action="<?php echo base_url(); ?>Roles/role_delete" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Role</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Delete this Role Permanently?</p>
               <input type="hidden" name="rid" id="rid">
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Yes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!--end::Modal-->


	</body>

   <script type="text/javascript">
      $('.finance_year').datepicker({
          format: "yyyy",
          minViewMode: 2,
        autoclose : true
          }).on('hide',function(date){
        $(".finance_year").val(date.target.value + "-" + (parseInt(date.target.value) + parseInt(1)));
      });
      function show_quick_icon(id_val, v, col)
      {  
         $('#'+id_val+'_label_'+v).hide();
         $('#'+id_val+'_'+v).show();
         $('#quick_edit_'+col+'_'+v).hide();
         $('#quick_save_'+col+'_'+v).show(); 
      }
      function show_quick_pencil_icon(id_val, v, col)
      {
         $('#quick_edit_'+col+'_'+v).show();
         $('#quick_save_'+col+'_'+v).hide();
         $('#'+id_val+'_label_'+v).show();
         $('#'+id_val+'_'+v).hide();
      }
      // To change lead type
      function update_target_counts(val, tar_id, type_val, quick_val, v, col)
      {
         var baseurl='<?php echo base_url(); ?>';
         var quote_count = $('#quote_count_'+v+'').val();
         $.ajax({
            type:'POST',
            url:baseurl+'Targets/update_target_counts',
            data:{'value':val, 'tar_id':tar_id, 'type_val':type_val},
            dataType: 'html',
            success:function(result){
               
               if(type_val == 'quote')
               {
                  $('#'+quick_val+'_label_'+v).html(quote_count);
                  
               }
               
               else{ }
               
               

               $('#'+quick_val+'_label_'+v).show();
               $('#quick_edit_'+col+'_'+v).show();
               $('#quick_save_'+col+'_'+v).hide();
               $('#'+quick_val+'_'+v).hide();
       
               
            }
         });
      }
      var pagecount = '';
      var current_pagination_index = '';
      function paginate_page(page,l_id)
      {  
         current_pagination_index = l_id;
         pagecount = page;
         submit_target_form('pagination');
      }

      var search_val = '';
      function search_on_list(val)
      {
         // if (val != '') {
          search_val = val;
          submit_target_form('search');
         // }
      }
      submit_target_form('filter');
      function submit_target_form(diff)
      {
         if(diff=='pagination') {
            current_pagination_index = current_pagination_index;
         }
         else{
            current_pagination_index = 1;
         }
         if (diff == 'search') {
            pagecount = 0;
         }
         else {
            pagecount = pagecount;
         }
         $('#tar_list_table_append_block_loader').show();
         $('#tar_list_table_append_block').hide();
         var fy = $('#target_year').val();
         var baseurl='<?php echo base_url(); ?>';

         var next_year = '';
         var funnel_year = '';
         if (fy.length == 4) {
            next_year = parseInt(fy) + 1;
            funnel_year = fy+'-'+next_year;
         }
         else {
            funnel_year = fy;
         }
         $.ajax({
            type:'POST',
            url:baseurl+'Targets/chk_filter_year_exist_or_not',
            data:{'year':funnel_year,'pagecount' : pagecount, 'search_val' : search_val, 'current_pagination_index' : current_pagination_index},
            dataType: 'html',
            success:function(result){
               
                  $('#tar_list_table_append_block').empty().append(result);
                  $('#tar_list_table_append_block_loader').hide();
                  $('#tar_list_table_append_block').show();
                          
            }
         });
      }
      function isNumberobj(evt,id_val) 
      {
          evt = (evt) ? evt : window.event;
          if (evt.which != 8 && evt.which != 43 && evt.which != 0 && (evt.which < 48 || evt.which > 57)) {
              $(id_val).html("Digits Only");
              return false;
          }
          else{
              $(id_val).html("");
              return true;
          }
      }
   </script>

	<!-- end::Body -->
</html>