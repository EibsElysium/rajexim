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
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">User Settings</span>
                              </a>
                           </li>
									<li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
									<li class="m-nav__item">
										<a href="<?php echo base_url(); ?>Roles" class="m-nav__link">
											<span class="m-nav__link-text">Role List</span>
										</a>
									</li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Create Role</span>
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
                        <div class="m-portlet m-portlet--mobile">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Create Role
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>Roles" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-angle-double-left"></i>
                                             <span>Back</span>
                                          </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <form  method="POST" action="<?php echo base_url(); ?>Roles/role_add" onsubmit="return role_validation();">
                           <div class="m-portlet__body">
                              <div class="row">
                                 <div class="col-xl-12">
                                    <div class="form-group m-form__group">
                                    <label>Role Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square"  aria-describedby="emailHelp" placeholder="Enter Role Name" id="rname" name="rname" onkeyup="unique_role(this.value);" autocomplete="off">
                                    <span id="rname_err" style="color:red"></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-12">
                                    <!--begin::Portlet-->
                                    <div class="m-portlet m-portlet--full-height">
                                       <div class="m-portlet__head">
                                          <div class="m-portlet__head-caption">
                                             <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                   Permission Setup
                                                </h3>
                                             </div>
                                          </div>
                                          <div class="pull-right">
                                             <div class="row" style="width: 250px;">
                                                <div class="col-lg-6">
                                                   <button class="btn btn-primary" type="button" style="margin-top: 12px;" id="expand_all_btn" onclick="expand_all_accordian_btn();">Expand All</button>
                                                   <button class="btn btn-primary" type="button" style="margin-top: 12px;display: none;" id="abstract_all_btn" onclick="abstract_all_accordian_btn();">Shrink All</button>
                                                </div>
                                                <div class="col-xl-6">
                                                      <div class="form-group m-form__group">
                                                         <label class="m-checkbox m-checkbox--bold m-checkbox--state-info mt_25px">
                                                            <input type="checkbox" name="selectAll" id="selectAll"> Select All
                                                            <span></span>
                                                         </label>
                                                      </div>
                                                </div>
                                             </div>
                                            

                                          </div>
                                       </div>
                                       <div class="m-portlet__body">

                                          <!--begin::Section-->
                                          <div class="m-accordion m-accordion--bordered" id="m_accordion_2" role="tablist">

                                             <?php foreach($menu_list as $menu){
                                             $id_val=$menu['menu_id'];
                                             $ci=& get_instance();
                                             $ci->load->database();
                                             $query2 = $ci->db->query("select * from menu where submenu_id='$id_val' AND flag = $ftype ");
                                             $sub_menu_list = $query2->result_array();
                                             $sub_menu_count = $query2->num_rows();
                                             if($sub_menu_count==0){ ?>

                                             <!--begin::Item-->
                                             <div class="m-accordion__item">
                                                <div class="accordian_head m-accordion__item-head collapsed" role="tab" id="m_accordion_2_item_<?php echo $menu['menu_id'];?>_head" data-toggle="collapse" href="#m_accordion_2_item_<?php echo $menu['menu_id'];?>_body" aria-expanded="    false">
                                                   <span class="m-accordion__item-title"><?php echo $menu['menu_name'];?></span>
                                                   <span class="m-accordion__item-mode"></span>
                                                </div>
                                                <div class="accordian_body m-accordion__item-body collapse" id="m_accordion_2_item_<?php echo $menu['menu_id'];?>_body" class=" " role="tabpanel" aria-labelledby="m_accordion_2_item_<?php echo $menu['menu_id'];?>_head" data-parent="#m_accordion_2">
                                                   <div class="m-accordion__item-content">
                                                      <div class="row">
                                                         <div class="col-lg-12">
                                                            <div class="col-lg-12">
                                                               <input type="hidden" id="menuId<?php echo $menu['menu_id'];?>" name="menuId[]" value="<?php echo $menu['menu_id'];?>">
                                                               <input type="hidden" id="subMenuId<?php echo $menu['menu_id'];?>" name="subMenuId[]" value="<?php echo $menu['submenu_id'];?>">
                                                               <input type="hidden" id="menuFields<?php echo $menu['menu_id'];?>" name="menuFields[]" value="<?php echo $menu['value'];?>">
                                                               <?php 
                                                               $mv = explode('~', $menu['value']);
                                                               for($i=0;$i<count($mv);$i++){
                                                               ?>
                                                               <div class="col-xl-3">
                                                                  <div class="form-group m-form__group">
                                                                     <label class="m-checkbox m-checkbox--bold m-checkbox--state-info">
                                                                        <input type="checkbox" class="menu_checkbox" id="<?php echo str_replace(' ', '', $mv[$i]);?><?php echo $menu['menu_id'];?>" name="value<?php echo $menu['menu_id'];?>[]" value="0" onchange="changePermission(this.id,this.value);if_filemanager_view_accepted_show(this.id,this.value,<?php echo $menu['menu_id']; ?>);"> <?php echo $mv[$i];?>
                                                                        <input type="hidden" class="menu_checkbox_hidden" id="<?php echo str_replace(' ', '', $mv[$i]);?><?php echo $menu['menu_id'];?>hidden" name="value<?php echo $menu['menu_id'];?>[]" value=0>
                                                                        <span></span>
                                                                     </label>
                                                                  </div>
                                                               </div>
                                                               <?php } ?>
                                                            </div>
                                                            <?php if($menu['menu_id'] == "74"){ ?>
                                                            <div class="col-lg-12" id="filemanager_accessiblity_block" style="display: none;">
                                                               <div class="col-lg-3">
                                                                  <div class="form-group m-form__group">
                                                                     <label class="m-checkbox m-checkbox--bold m-checkbox--state-info mt_25px">
                                                                        <input type="checkbox" name="add_folders_to_user" id="add_folders_to_user" onchange="chk_to_show_folders();"> Give a Folder Access..
                                                                        <input type="hidden" name="role_has_acc" id="role_has_acc" value="0">
                                                                        <span></span>
                                                                     </label>
                                                                  </div>
                                                               </div>
                                                               <div class="col-lg-3">
                                                                  <div class="form-group m-form__group" id="folders_list_block" style="display: none;">
                                                                     <select id="role_folders" name="role_folders[]" multiple class="form-control m_selectpicker" data-live-search="true">
                                                                        <?php foreach ($get_all_folder_access as $f_acc_list) { ?>
                                                                           <option value="<?php echo $f_acc_list->f_id; ?>"><?php echo $f_acc_list->folder_name; ?></option>
                                                                        <?php } ?>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <?php } ?>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <?php } else { ?>
                                             <div class="m-accordion__item">
                                                <div class="accordian_head m-accordion__item-head collapsed" role="tab" id="m_accordion_2_item_<?php echo $menu['menu_id'];?>_head" data-toggle="collapse" href="#m_accordion_2_item_<?php echo $menu['menu_id'];?>_body" aria-expanded="    false">
                                                   <span class="m-accordion__item-title"><?php echo $menu['menu_name'];?></span>
                                                   <span class="m-accordion__item-mode"></span>
                                                </div>
                                                <div class="accordian_body m-accordion__item-body collapse" id="m_accordion_2_item_<?php echo $menu['menu_id'];?>_body" class=" " role="tabpanel" aria-labelledby="m_accordion_2_item_<?php echo $menu['menu_id'];?>_head" data-parent="#m_accordion_2">
                                                   <div class="m-accordion__item-content">
                                                   <?php foreach($sub_menu_list as $s_m_list){?>
                                                      <div class="row">
                                                         <div class="col-lg-12">
                                                               <div class="form-group m-form__group">
                                                                  <label> <?php echo $s_m_list['menu_name'];?>
                                                                  </label>
                                                               </div>
                                                         </div>
                                                      </div>
                                                      <input type="hidden" id="menuId<?php echo $s_m_list['menu_id'];?>" name="menuId[]" value="<?php echo $s_m_list['menu_id'];?>">
                                                      <input type="hidden" id="subMenuId<?php echo $s_m_list['menu_id'];?>" name="subMenuId[]" value="<?php echo $s_m_list['submenu_id'];?>">
                                                      <input type="hidden" id="menuFields<?php echo $s_m_list['menu_id'];?>" name="menuFields[]" value="<?php echo $s_m_list['value'];?>">
                                                      <div class="row">
                                                         <div class="col-lg-12">
                                                            <div class="col-lg-12">
                                                               <?php $mv = explode('~', $s_m_list['value']);
                                                               for($i=0;$i<count($mv);$i++){
                                                               ?>
                                                               <div class="col-xl-3">
                                                                  <div class="form-group m-form__group">
                                                                     <label class="m-checkbox m-checkbox--bold m-checkbox--state-info">
                                                                        <input type="checkbox" class="submenu_checkbox" id="<?php echo str_replace(' ', '', $mv[$i]);?><?php echo $s_m_list['menu_id'];?>" name="value<?php echo $s_m_list['menu_id'];?>[]" value="0" onchange="changePermission(this.id,this.value);"> <?php echo $mv[$i];?>
                                                                        <input type="hidden" class="submenu_checkbox_hidden" id="<?php echo str_replace(' ', '', $mv[$i]);?><?php echo $s_m_list['menu_id'];?>hidden" name="value<?php echo $s_m_list['menu_id'];?>[]" value=0>
                                                                        <span></span>
                                                                     </label>
                                                                  </div>
                                                               </div>
                                                            <?php }?>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   <?php }?>
                                                   </div>
                                                </div>
                                             </div>
                                             <?php } } ?>

                                             <!--end::Item-->

                                          </div>

                                          <!--end::Section-->
                                       </div>
                                    </div>

                                    <!--end::Portlet-->
                                    
                                 </div>
                              </div>
                           </div>
                           <div class="m-portlet__foot">
                              <div class="row align-items-center">
                                 <!-- <div class="col-lg-3 m--align-left">
                                    <div class="form-group m-form__group">
                                       <label class="m-checkbox m-checkbox--bold m-checkbox--state-info mt_25px">
                                          <input type="checkbox" name="add_folders_to_user" id="add_folders_to_user" onchange="chk_to_show_folders();"> Give a Folder Access..
                                          <input type="hidden" name="role_has_acc" id="role_has_acc" value="0">
                                          <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="form-group m-form__group" id="folders_list_block" style="display: none;">
                                       <select id="role_folders" name="role_folders[]" multiple class="form-control m_selectpicker" data-live-search="true">
                                          <?php foreach ($get_all_folder_access as $f_acc_list) { ?>
                                             <option value="<?php echo $f_acc_list->f_id; ?>"><?php echo $f_acc_list->folder_name; ?></option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                 </div> -->
                                 <div class="col-lg-6"></div>
                                 <div class="col-lg-6 m--align-right">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <button type="button" style="color:black;" class="btn btn-default" onclick="return closeBtn()">Cancel</button>
                                 </div>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>
                  </div>

                  <!--End::Section-->
               </div>
				</div>
			</div>

			<!-- end:: Body -->
         <input type="hidden" id='baseurl' name="baseurl" value="<?php echo base_url();?>">
			<?php $this->load->view('common_footer'); ?>

<!--begin::Modal-->
<div class="container">
   <div class="modal fade" id="role_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Role</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Delete this Role Permanently?</p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-primary">Yes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
         </div>
      </div>
   </div>
</div>
<!--end::Modal-->


	</body>
   <script type="text/javascript">
      function expand_all_accordian_btn()
      {
         // alert('Hi');
         $(".accordian_head").removeClass("collapsed");
         $(".accordian_body").addClass("show"); 
         $('#expand_all_btn').hide();
         $('#abstract_all_btn').show();
      }

      function abstract_all_accordian_btn()
      {
         $(".accordian_head").addClass("collapsed");
         $(".accordian_body").removeClass("show"); 
         $('#expand_all_btn').show();
         $('#abstract_all_btn').hide();
      }

      function chk_to_show_folders()
      {
         if($('#add_folders_to_user').is(":checked"))
         {
            $("#role_has_acc").val('1');
            $("#folders_list_block").show();
         }
         else
         {
            $("#role_has_acc").val('0');
            $("#folders_list_block").hide();
         }
      }
      $("#selectAll").click(function () {
         if ($(this).prop("checked") == true){
           $('.menu_checkbox').prop('checked', true);
           $('.submenu_checkbox').prop('checked',true);
           $(".menu_checkbox:checked").each(function(){
            var rid = $(this).attr('id');
                   $("#"+rid).val(1);
         });
          $(".submenu_checkbox:checked").each(function(){
            var rid = $(this).attr('id');
            
                   $("#"+rid).val(1);              
         });
          $(".menu_checkbox_hidden").each(function(){
            var rhid = $(this).attr('id');
                   $("#"+rhid).attr("disabled", "disabled");
         });
          $(".submenu_checkbox_hidden").each(function(){
            var rhid = $(this).attr('id');
            
                   $("#"+rhid).attr("disabled", "disabled");          
         });
         }
         if($(this).prop("checked") == false){
             
             $(".menu_checkbox:checked").each(function(){
              var rid = $(this).attr('id');
                     $("#"+rid).val(0);
           });
            $(".submenu_checkbox:checked").each(function(){
              var rid = $(this).attr('id');
              
                     $("#"+rid).val(0);              
           });
            $('.menu_checkbox').prop('checked', false);
           $('.submenu_checkbox').prop('checked',false);
            $(".menu_checkbox_hidden").each(function(){
            var rhid = $(this).attr('id');
                   $("#"+rhid).removeAttr("disabled");
         });
          $(".submenu_checkbox_hidden").each(function(){
            var rhid = $(this).attr('id');
            
                   $("#"+rhid).removeAttr("disabled");        
         });
         }
      });



      var rer = 0;
      function unique_role(val)
      {
         var baseurl= $("#baseurl").val();
         if(val != '')
         {
            $.ajax({
               type:"POST",
               url:baseurl+'Roles/unique_role',
               data:{'value':val},
               cache: false,
               dataType: "html",
                  success: function(result){
                  if(result>0)
                  {
                     $('#rname_err').html('Role Name already exist!!');
                     rer = 1;
                  }
                  else
                  {
                     $('#rname_err').html('');
                     rer = 0;
                  }
               }
            });
         }
      }

      function role_validation()
      {
         var err = 0;
         var rname = $('#rname').val();
         if(rname=='')
         {
            $('#rname_err').html('Role Name is required!');
            err++;
         }
         else
         {
            if(rer>0)
            {
               $('#rname_err').html('Role Name already exist!!');
               err++;
            }
            else
            {
               $('#rname_err').html('');
            }
         }
         if(err>0){ return false; }else{ return true; }
      }

      function changePermission(id,val)
      {
         if(val==1)
         {
            $('#'+id).val(0);
            document.getElementById(id+'hidden').disabled = false;
         }
         else
         {
            $('#'+id).val(1);
            document.getElementById(id+'hidden').disabled = true;
         }
      }
      function if_filemanager_view_accepted_show(id,val,filemanager_id)
      {
         if (filemanager_id == 74) {
            if (val == 0) {
               $('#filemanager_accessiblity_block').hide();
               $('#role_has_acc').val('0');
               $("#add_folders_to_user"). prop("checked", false);
            }
            else {
               $('#filemanager_accessiblity_block').show();
            }
         }
      }
      function closeBtn()
      {
         window.location.href = "<?php echo base_url(); ?>"+"roles";
      }
   </script>

	<!-- end::Body -->
</html>