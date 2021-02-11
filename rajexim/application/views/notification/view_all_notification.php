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
                                 <span class="m-nav__link-text">Notitfication</span>
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
                                       Notification
                                    </h3>
                                 </div>
                              </div> 
                           </div>
                           <div class="m-portlet__body">
                              <!--begin: Datatable -->
                              <form action="<?php echo base_url(); ?>Notifications/view_all_notification" method="POST" id="filterform"> 
                                <div class="row">
                                  <div class="col-lg-3">
                                        <div class="form-group m-form__group">
                                           <label class="label">Notification Type</label>
                                           <select class="custom-select form-control" name="ntype" id="ntype" onchange="filter_validation()">
                                              <option <?php echo($ntype == '')? 'selected' : '' ; ?> value="">All</option>
                                              <?php foreach($notification_type as $nt){ ?> 
                                              <option <?php echo ($ntype == $nt->notification_type_id)? 'selected' : ''; ?> value="<?php echo $nt->notification_type_id; ?>"><?php echo $nt->notification_type; ?></option>
                                              <?php } ?>
                                           </select>
                                        </div>
                                     </div>
                                 <!--   <div class="col-lg-3 dp" id="date_fil" style="<?php //echo $purchasesearch=='selectdate'?'display:inline-block':'display:none';?>">
                                      <div class="form-group">
                                         <label>Date</label>
                                         <input type="text" class="form-control m_datepicker_1" id="list_date" name="list_date" value="<?php //echo ($purchasesearch=='selectdate') ? $list_date : ''; ?>" placeholder="Enter Date" readonly>
                                          <span id="list_date_err" class="text-danger"></span>
                                      </div>
                                   </div> -->

                                   <div class="col-lg-3 drp" id="date_range">
                                      <div class="m-input-icon pull-right" id='m_daterangepicker_3'>
                                         <label class="label">Date Range</label>
                                         <input type="text" class="form-control m-input" placeholder="Enter Date Range" id="list_product_date" name="list_product_date" value="<?php echo ($list_product_date) ? $list_product_date : ''; ?>" readonly>
                                        <span id="list_product_date_err" class="text-danger"></span>
                                      </div>
                                   </div>
                                   
                                   <div class="col-lg-1 gobtn" >
                                      <div class="form-group m-form__group mt_25px">
                                         <button type="button" class="btn btn-primary " onclick="filter_validation()"><i class="la la-filter"></i> Proceed</button>
                                      </div>
                                   </div>
                                </div>
                              </form>
                              <div class="m-timeline-3 mt_27px">
                                <div class="m-timeline-3__items list">
                                  <!-- <?php //echo "<pre>"; echo print_r($notification); ?> -->
                                  <?php $i=1; foreach ($notification as $noti) { 
                                   $noti_read = get_read_notify_message($_SESSION['admindata']['user_id'],$noti->notification_id);
                                   $cont = get_notification_content($noti); 
                                   $agotime = time_elapsed_string_in_helper($noti->created_on);
                                   ?>
                                  <div class="m-timeline-3__item m-timeline-3__item--info">
                                    <span class="m-timeline-3__item-time noti_bell">
                                      <?php if($noti->notification_type_id == 1){ ?>
                                      <i class="la la-user-plus" ></i>
                                      <?php }else if($noti->notification_type_id == 2){ ?>
                                      <i class="la la-calendar" ></i>
                                      <?php }else if($noti->notification_type_id == 3){ ?>
                                      <i class="la la-reorder" ></i>
                                      <?php }else if($noti->notification_type_id == 4){ ?>
                                      <i class="la la-comments" ></i>
                                      <?php }else if($noti->notification_type_id == 5){ ?>
                                      <i class="la la-reorder"></i>
                                      <?php }else if($noti->notification_type_id == 6){ ?>
                                      <i class="la la-comment" ></i>
                                      <?php } ?>
                                    </span>
                                    <div class="m-timeline-3__item-desc">
                                      <span class="m-timeline-3__item-text">
                                       <?php echo $cont; ?>
                                      </span><br>
                                      
                                      <span class="m-timeline-3__item-user-name"><?php echo $agotime; ?></span>
                                    </div>
                                  </div>
                                  <?php $i++; } ?>
                                  
                                </div>
                                <button id="next" class="btn btn-primary">Show More</button>
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

   
<script>
$(document).ready(function(){

    var list = $(".list div");
    var numToShow = 12;
    var button = $("#next");
    var numInList = list.length;
    list.hide();
    if (numInList > numToShow) {
      button.show();
    }
    list.slice(0, numToShow).show();

    button.click(function(){
        var showing = list.filter(':visible').length;
        list.slice(showing - 1, showing + numToShow).fadeIn();
        var nowShowing = list.filter(':visible').length;
        if (nowShowing >= numInList) {
          button.hide();
        }
    });

});
function filter_validation()
 {
    var err = 0;
    var searchChange = $('#searchChange').val();
    var list_date = $('#list_date').val();
    var list_product_date = $('#list_product_date').val();

    if(searchChange == 'selectdate')
    {
       if(list_date == '')
       {
          $('#list_date_err').html('Date is required!');
          err++;
       }
       else
       {
          $('#list_date_err').html('');
       }
    }
    else if(searchChange == 'thisDate')
    {
       if(list_product_date == '')
       {
          $('#list_product_date_err').html('Date Range is required!');
          err++;
       }
       else
       {
          $('#list_product_date_err').html('');
       }
    }

    if(err>0){  }else{ $('#filterform').submit(); }
 }
</script>
</body>
   <!-- end::Body -->
</html>