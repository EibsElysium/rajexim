<?php 

  // shell_exec('php index.php welcome index');
 	$g_settings = common_select_values('*', 'general_settings', '', 'row');
 	$p_logo  = isset($g_settings->product_logo) ? base_url().'assets/common_images/'.$g_settings->product_logo : base_url().'assets/images/logo.png';

 	$user_id = $_SESSION['admindata']['user_id'];
 	$profile = common_select_values('*', 'users', 'user_id = "'.$user_id.'"', 'row');
 	if(!empty($profile) && $profile->profile_image!='')
 	{
 		$p_image = base_url().'assets/user_profile/'.$profile->profile_image;
 	}
 	else
 	{
 		$p_image = base_url().'assets/images/default_image.jpg';
 	}

 	
?>
<style>
	body {
  background:#777;
}
.shake {
  animation: shake 0.82s cubic-bezier(.36, .07, .19, .97) both infinite;
  transform: translate3d(0, 0, 0);
  backface-visibility: hidden;
  perspective: 1000px;
  display: inline-block;
}

@keyframes shake {
  10%,
  90% {
    transform: translate3d(-1px, 0, 0);
  }
  20%,
  80% {
    transform: translate3d(2px, 0, 0);
  }
  30%,
  50%,
  70% {
    transform: translate3d(-4px, 0, 0);
  }
  40%,
  60% {
    transform: translate3d(4px, 0, 0);
  }
}
#mycalculator {
  position: absolute;
  background-color: #f1f1f1;
  text-align: center;
  border: 1px solid #d3d3d3;
  z-index: 9999;
  resize: both;
  overflow: auto;
}

#mycalculatorheader {
  padding: 10px;
  cursor: move;
  z-index: 10;
  background-color: #203876;
  color: #fff;
}
#background {
    width:300px;
    height:368px;
    background:#dfdfdf;
    margin:0px auto;
    margin-top: -10px;
}

button {
    border:0;
    color:#fff;
}

#result {
    display:block;
    font-family: sans-serif;
    width:225px;
    height:40px;
    margin:10px auto;
    text-align: right;
    border:0;
    background:#3b3535;
    color:#fff;
    padding-top:10px;
    font-size:20px;
    margin-left: 36px;
    outline: none;
    overflow: hidden;
    letter-spacing: 4px;
    position: relative;
    top:10px;
}

#result:hover {
    
    cursor: text;
    
}

#first-rows {
    margin-bottom: 20px;
    position: relative;
    top:10px;
    margin-left: -27px;
}

.rows {
    width:300px;
    margin-top:10px;
    margin-left: -13px;
}

#delete {
    width:110px;
    height:50px;
    margin-left:25px;
    border-radius:4px;
}

/* Aligning the division and dot button properly */
.fall-back {
    margin-left:3px !important;
}

/* Aligning the addition and equals to button properly */
.align {
    margin-left: 6px !important;
}

/* Button styling */
.btn-style {
    width:50px;
    height:50px;
    margin-left:5px;
    border-radius:4px;
}

.eqn {
    width:50px;
    height:50px;
    margin-left:5px;
    border-radius:4px;
}

.first-child {
 margin-left:25px;
}


/* Adding background color to the number values */
 .num-bg {
    background:#000;
    color:#fff;
    font-size:26px;
    cursor:pointer;
    outline:none;
    border-bottom:3px solid #333;
}

 .num-bg:active {
    background:#000;
    color:#fff;
    font-size:26px;
    cursor:pointer;
    outline:none;
    box-shadow: inset 5px 5px 5px #555;
}

/*Adding background color to the operator values */ 
.opera-bg {
    background:#333;
    color:#fff;
    font-size:26px;
    cursor: pointer;
    outline:none;
    border-bottom:3px solid #555;
}

.opera-bg:active {
    background:#333;
    color:#fff;
    font-size:26px;
    cursor: pointer;
    outline:none;
    box-shadow: inset 4px 4px 4px #555;
}

/*Adding a background color to the delete button */
.del-bg {
    background:#203876;
    color:#fff;
    font-size:26px;
    cursor: pointer;
    outline:none;
    border-bottom:3px solid #203876;
}

.del-bg:active {
    background:#2196F3;
    color:#fff;
    font-size:26px;
    cursor: pointer;
    outline:none;
    box-shadow: inset 4px 4px 4px #2196F3;
}

/*Adding a background color to the equals to button */
#eqn-bg {
    background:#17a928;
    color:#fff;
    font-size:26px;
    cursor: pointer;
    outline:none;
    border-bottom:3px solid #1f7a29;
}

#eqn-bg:active {
    background:#17a928;
    color:#fff;
    font-size:26px;
    cursor: pointer;
    outline:none;
    box-shadow: inset 4px 4px 4px #1f7a29;
}

@-webkit-keyframes bgChange {
    0% {
       background:#24b4de; 
    }
    
    50% {
      background:#17a928;
    }
    
    100% {
        background:#399cb9;
    }
}
.task_notification_list_styles {
    background: #e0eef5;
    padding: 10px;
    margin: 7px;
}
</style>
<script>
	window.onload = function() {

var current,
    screen,
    output,
    limit,
    zero,
    period,
    operator;
    
    screen = document.getElementById("result");

var elem = document.querySelectorAll(".numc");
      
      var len = elem.length;
    
      for(var i = 0; i < len; i++ ) {
        
        elem[i].addEventListener("click",function() {
                  
            num = this.value;
                     
            output = screen.innerHTML +=num;
                  
            limit = output.length;
         
         if(limit > 16 ) {
        
         alert("Sorry no more input is allowed");
             
       }
       
     },false);
        
    } 

    document.querySelector(".zero").addEventListener("click",function() {
        
        zero = this.value;
        
        if(screen.innerHTML === "") {
            
           output = screen.innerHTML = zero;  
        }
        
        else if(screen.innerHTML === output) {
            
         output = screen.innerHTML +=zero;
            
        }
          
    },false);
    
    document.querySelector(".period").addEventListener("click",function() {
        
        period = this.value;
        
        if(screen.innerHTML === "") {
            
         output = screen.innerHTML = screen.innerHTML.concat("0.");
            
         }
    
        else if(screen.innerHTML === output) {
        
          screen.innerHTML = screen.innerHTML.concat(".");
            
        }
        
    },false);
    
    
    document.querySelector("#eqn-bg").addEventListener("click",function() {
        
      if(screen.innerHTML === output) {
          
        screen.innerHTML = eval(output);
        
        output = screen.innerHTML;
        
      }
        
      else {
            screen.innerHTML = "";
      }
          
    },false);
    
 document.querySelector("#delete").addEventListener("click",function() {
        
        screen.innerHTML = "";
        
    },false);
    
   
     var elem1 = document.querySelectorAll(".operator");
    
      var len1 = elem1.length;
    
      for(var i = 0; i < len1; i++ ) {
        
        elem1[i].addEventListener("click",function() {
         
        operator = this.value;
         
         if(screen.innerHTML === "") {
            
            screen.innerHTML = screen.innerHTML.concat("");
            
        }
        
        else if(output) {
        
            screen.innerHTML = output.concat(operator);
            
        }
           
    },false);
          
      }   
}
function hide_calculator()
{
	$('#mycalculator').hide();
}
function show_calculator()
{
	$('#mycalculator').show();
}
</script>
<?php
if($profile->show_menu == 0)
{ ?>

<header id="m_header" class="m-grid__item  m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
	<div class="m-container m-container--fluid m-container--full-height">
		<div class="m-stack m-stack--ver m-stack--desktop">

			<!-- BEGIN: Brand -->
			<div class="m-stack__item m-brand  m-brand--skin-dark ">
				<div class="m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-stack__item--middle m-brand__logo">
						<a href="<?php echo base_url(); ?>Leads" class="m-brand__logo-wrapper">
							<img alt="" src="<?php echo $p_logo; ?>" width="100" height="50" />
						</a>
					</div>
					<div class="m-stack__item m-stack__item--middle m-brand__tools">


						<!-- BEGIN: Left Aside Minimize Toggle -->
						<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
							<span></span>
						</a>

						<!-- END -->

						<!-- BEGIN: Responsive Aside Left Menu Toggler -->
						<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
							<span></span>
						</a>

						<!-- END -->

						<!-- BEGIN: Responsive Header Menu Toggler -->
						<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
							<span></span>
						</a>

						<!-- END -->

						<!-- BEGIN: Topbar Toggler -->
						<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
							<i class="flaticon-more"></i>
						</a>

						<!-- BEGIN: Topbar Toggler -->
					</div>
				</div>
			</div>

			<!-- END: Brand -->
			<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

				<!-- BEGIN: Horizontal Menu -->
				<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>

				<!-- END: Horizontal Menu -->

				<!-- BEGIN: Topbar -->
				<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-topbar__nav-wrapper">
						<ul class="m-topbar__nav m-nav m-nav--inline">
              <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" id="mail_loader_indicator" style="display: none;">
                
                <a href="javascript:;" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                  <span class="m-nav__link-icon">
                    <span class="m-nav__link-icon-wrapper"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Email Loading"><i class="fa fa-envelope-o fa-spin"></i></span></span>
                    
                  </span>
                </a>

              </li>
              <?php if($_SESSION['TasksView']==1){ ?>
                <?php 
                  $not_tot_task = get_task_notify_countByUser();
                  $not_tot = get_notify_countByUser();
                  $all_noti = get_notify_message();
                ?>
              <li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center   m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
                <a href="javascript:;" onclick="change_status();" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                <span class="m-nav__link-icon">
                <span class="m-nav__link-icon-wrapper"><i class="la la-tasks"></i></span>
                <span id="countspan"><?php $get_all_pending_tasks = get_all_pending_tasks(); if(count($get_all_pending_tasks) != 0){ ?><span class="animated shake m-nav__link-badge m-badge m-badge--danger noti_count" id="badge"><?php echo count($get_all_pending_tasks); ?></span><?php } ?></span>
                </span>
                </a>
                <div class="m-dropdown__wrapper" style="left: -71px !important">
                   <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                   <div class="m-dropdown__inner">
                      <div class="m-dropdown__body">
                         <div class="m-dropdown__content">
                           <div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
                               <div class="m-list-timeline m-list-timeline--skin-light">
                                  <!-- <div class="row">
                                    <div class="col-md-4">
                                      <div class="card-small">
                                        <p class="card__name">
                                            <span>All</span>
                                        </p>
                                        <i class="la la-filter lalead"></i>
                                                   
                                        <div class="card__number">1<span class="card_tod_green"></span></div>
                                                         
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="card-small">
                                        <p class="card__name">
                                            <span>Pending</span>
                                        </p>
                                        <i class="la la-filter laoppo"></i>
                                                   
                                        <div class="card__number">1<span class="card_tod_green"></span></div>
                                                         
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="card-small">
                                        <p class="card__name">
                                            <span>Over</span>
                                        </p>
                                        <i class="la la-filter laquot"></i>
                                                   
                                        <div class="card__number">1<span class="card_tod_green"></span></div>
                                                         
                                      </div>
                                    </div>
                                  </div> -->
                                  <?php 

                                    $get_all_today_tasks = get_all_today_tasks(); 

                                    // $get_all_pending_tasks = get_all_pending_tasks();

                                    $get_all_upcoming_tasks = get_all_upcoming_tasks();
                                  ?>
                                  <div class="m-portlet__head-tools">
                                     <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                        <li class="nav-item m-tabs__item">
                                           <a class="nav-link m-tabs__link nav-link-pad active show" data-toggle="tab" href="#m_widget2_tab2_content1_today" role="tab">
                                           Today (<?php echo count($get_all_today_tasks); ?>)
                                           </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                           <a class="nav-link m-tabs__link nav-link-pad " data-toggle="tab" href="#m_widget2_tab4_content1_pen" role="tab">
                                           Pending (<?php echo count($get_all_pending_tasks); ?>)
                                           </a>
                                        </li> 
                                        <li class="nav-item m-tabs__item">
                                           <a class="nav-link m-tabs__link nav-link-pad " data-toggle="tab" href="#m_widget2_tab2_content1_upcoming" role="tab">
                                           Upcoming (<?php echo count($get_all_upcoming_tasks); ?>)
                                           </a>
                                        </li>
                                     </ul>
                                  </div>
                                  <div class="tab-content">
                                   <div class="tab-pane active show m-list-timeline__items noti_li" id="m_widget2_tab4_content1_pen">
                                      
                                      <div class="timeline timeline-3">
                                         <div class="timeline-items">
                                            <?php 
                                             if (count($get_all_pending_tasks) > 0) {

                                                $t_i=1; foreach ($get_all_pending_tasks as $today_noti) { 
                                                // if($noti_read==0)
                                                //    {
                                                //       $rcolor = '#e6f2fe';
                                                //    }
                                                //    else
                                                //    {
                                                //       $rcolor = '';
                                                //    }
                                                    ?>
                                             <div id="today_noti<?php echo $t_i; ?>" style="cursor:pointer;" class="m-list-timeline__item task_notification_list_styles" >
                                                <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                <span class="m-list-timeline__text">
                                                  <?php if($today_noti->task_type == 0 && $today_noti->buyer_order_no == ''){ ?>
                                                    <div class="row">
                                                      <div class="col-md-2">
                                                        <i class="flaticon-calendar-with-a-clock-time-tools"></i>  
                                                      </div>
                                                      <div class="col-md-10">
                                                        <span class="text-green"><?php echo $today_noti->name; ?></span>, You Have a <span class="text-orange"><?php echo $today_noti->task_title; ?></span> Task With <span class="text-danger"><?php echo $today_noti->priority; ?></span> Priority Ended On <span class="text-danger"><?php echo time_elapsed_string_in_helper($today_noti->task_end_date_both);  ?></span>,    
                                                      </div>
                                                    </div>
                                                    
                                                  <?php }else if($today_noti->task_type == 0 && $today_noti->buyer_order_no != ''){ ?>
                                                    <div class="row">
                                                      <div class="col-md-2">
                                                        <i class="la la-list"></i>
                                                      </div>
                                                      <div class="col-md-10">
                                                        <span class="text-green"><?php echo $today_noti->name; ?></span>, You Have a <span class="text-orange"><?php echo $today_noti->task_title; ?></span> Buyer Order Task With <span class="text-danger"><?php echo $today_noti->priority; ?></span> Priority Ended On <span class="text-danger"><?php echo time_elapsed_string_in_helper($today_noti->task_end_date_both);  ?></span>, 
                                                      </div>
                                                    </div>
                                                    
                                                  <?php }else if($today_noti->task_type == 1){ ?>
                                                    <div class="row">
                                                      <div class="col-md-2">
                                                        <i class="la la-calendar-check-o"></i> 
                                                      </div>
                                                      <div class="col-md-10">
                                                        <span class="text-green"><?php echo $today_noti->name; ?></span>, You Have a <span class="text-orange"><?php echo $today_noti->task_title; ?></span> General Task With <span class="text-danger"><?php echo $today_noti->priority; ?></span> Priority Ended On <span class="text-danger"><?php echo time_elapsed_string_in_helper($today_noti->task_end_date_both);  ?></span>,   
                                                      </div>
                                                    </div>
                                                    
                                                  <?php } ?>
                                                </span>
                                                
                                             </div>
                                          <?php $t_i++; } } else { ?>
                                            <div style="background-color:#fff;" class="m-list-timeline__item" >
                                                <p class="text-center" style="font-size: 15px;">Task Notification is Empty</p>
                                                <p class="text-center"><i class="la la-tasks" style="font-size: 20px;"></i></p>
                                             </div>
                                          <?php } ?>
                                         </div>
                                      </div>
                                   </div>

                                   <div class="tab-pane" id="m_widget2_tab2_content1_upcoming">
                                      
                                      <div class="timeline timeline-3">
                                         <div class="timeline-items">
                                            <?php 
                                             if (count($get_all_upcoming_tasks) > 0) {

                                                $t_i=1; foreach ($get_all_upcoming_tasks as $today_noti) { 
                                                //    if($noti_read==0)
                                                //    {
                                                //       $rcolor = '#e6f2fe';
                                                //    }
                                                //    else
                                                //    {
                                                //       $rcolor = '';
                                                //    }
                                                    ?>
                                             <div id="today_noti<?php echo $t_i; ?>" style="cursor:pointer;" class="m-list-timeline__item task_notification_list_styles" >
                                                <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                <span class="m-list-timeline__text">
                                                  <?php if($today_noti->task_type == 0 && $today_noti->buyer_order_no == ''){ ?>
                                                    <div class="row">
                                                      <div class="col-md-2">
                                                        <i class="flaticon-calendar-with-a-clock-time-tools"></i>  
                                                      </div>
                                                      <div class="col-md-10">
                                                        <span class="text-green"><?php echo $today_noti->name; ?></span>, You Have a <span class="text-orange"><?php echo $today_noti->task_title; ?></span> Task With <span class="text-danger"><?php echo $today_noti->priority; ?></span> Priority Coming On <span class="text-danger"><?php echo time_elapsed_string_in_helper($today_noti->task_start_date_both);  ?></span>,    
                                                      </div>
                                                    </div>
                                                    
                                                  <?php }else if($today_noti->task_type == 0 && $today_noti->buyer_order_no != ''){ ?>
                                                    <div class="row">
                                                      <div class="col-md-2">
                                                        <i class="la la-list"></i>
                                                      </div>
                                                      <div class="col-md-10">
                                                        <span class="text-green"><?php echo $today_noti->name; ?></span>, You Have a <span class="text-orange"><?php echo $today_noti->task_title; ?></span> Buyer Order Task With <span class="text-danger"><?php echo $today_noti->priority; ?></span> Priority Coming On <span class="text-danger"><?php echo time_elapsed_string_in_helper($today_noti->task_end_date_both);  ?></span>, 
                                                      </div>
                                                    </div>
                                                    
                                                  <?php }else if($today_noti->task_type == 1){ ?>
                                                    <div class="row">
                                                      <div class="col-md-2">
                                                        <i class="la la-calendar-check-o"></i> 
                                                      </div>
                                                      <div class="col-md-10">
                                                        <span class="text-green"><?php echo $today_noti->name; ?></span>, You Have a <span class="text-orange"><?php echo $today_noti->task_title; ?></span> General Task With <span class="text-danger"><?php echo $today_noti->priority; ?></span> Priority Coming On <span class="text-danger"><?php echo time_elapsed_string_in_helper($today_noti->task_start_date_both);  ?></span>,   
                                                      </div>
                                                    </div>
                                                    
                                                  <?php } ?>
                                                </span>
                                                
                                             </div>
                                          <?php $t_i++; } } else { ?>
                                            <div style="background-color:#fff;" class="m-list-timeline__item" >
                                                <p class="text-center" style="font-size: 15px;">Task Notification is Empty</p>
                                                <p class="text-center"><i class="la la-tasks" style="font-size: 20px;"></i></p>
                                             </div>
                                          <?php } ?>
                                         </div>
                                      </div>
                                   </div>

                                   <div class="tab-pane" id="m_widget2_tab2_content1_today">
                                      
                                      <div class="timeline timeline-3">
                                         <div class="timeline-items">
                                            <?php 
                                             if (count($get_all_today_tasks) > 0) {

                                                $t_i=1; foreach ($get_all_today_tasks as $today_noti) { 
                                                // if($noti_read==0)
                                                //    {
                                                //       $rcolor = '#e6f2fe';
                                                //    }
                                                //    else
                                                //    {
                                                //       $rcolor = '';
                                                //    }
                                                    ?>
                                             <div id="today_noti<?php echo $t_i; ?>" style="cursor:pointer;" class="m-list-timeline__item task_notification_list_styles" >
                                                <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                <span class="m-list-timeline__text">
                                                  <?php if($today_noti->task_type == 0 && $today_noti->buyer_order_no == ''){ ?>
                                                    <div class="row">
                                                      <div class="col-md-2">
                                                        <i class="flaticon-calendar-with-a-clock-time-tools"></i>  
                                                      </div>
                                                      <div class="col-md-10">
                                                        <span class="text-green"><?php echo $today_noti->name; ?></span>, You Have a <span class="text-orange"><?php echo $today_noti->task_title; ?></span> Task With <span class="text-danger"><?php echo $today_noti->priority; ?></span> Priority On Today,    
                                                      </div>
                                                    </div>
                                                    
                                                  <?php }else if($today_noti->task_type == 0 && $today_noti->buyer_order_no != ''){ ?>
                                                    <div class="row">
                                                      <div class="col-md-2">
                                                        <i class="la la-list"></i>
                                                      </div>
                                                      <div class="col-md-10">
                                                        <span class="text-green"><?php echo $today_noti->name; ?></span>, You Have a <span class="text-orange"><?php echo $today_noti->task_title; ?></span> Buyer Order Task With <span class="text-danger"><?php echo $today_noti->priority; ?></span> Priority On Today, 
                                                      </div>
                                                    </div>
                                                    
                                                  <?php }else if($today_noti->task_type == 1){ ?>
                                                    <div class="row">
                                                      <div class="col-md-2">
                                                        <i class="la la-calendar-check-o"></i> 
                                                      </div>
                                                      <div class="col-md-10">
                                                        <span class="text-green"><?php echo $today_noti->name; ?></span>, You Have a <span class="text-orange"><?php echo $today_noti->task_title; ?></span> General Task With <span class="text-danger"><?php echo $today_noti->priority; ?></span> Priority On Today Also,   
                                                      </div>
                                                    </div>
                                                    
                                                  <?php } ?>
                                                </span>
                                                
                                             </div>
                                          <?php $t_i++; } } else { ?>
                                            <div style="background-color:#fff;" class="m-list-timeline__item" >
                                                <p class="text-center" style="font-size: 15px;">Task Notification is Empty</p>
                                                <p class="text-center"><i class="la la-tasks" style="font-size: 20px;"></i></p>
                                             </div>
                                          <?php } ?>
                                         </div>
                                      </div>
                                   </div>
                                 </div>


                                  <!-- here append that -->
                               </div>
                           </div>
                         </div>
                      </div>

                      <div class="m-dropdown__header m--align-center" style="border-top: 2px solid #ddd;">
                         <h5><span class="m-dropdown__header-subtitle"><a href="javascript:;" onclick="open_task_page();" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon" style="color: #fff;">View All Tasks</a></span></h5>
                      </div>
                   </div>
                </div>
              </li>
              <!-- <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light">
                
                <a href="<?php echo base_url(); ?>task" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                  <span class="m-nav__link-icon">
                    <span class="m-nav__link-icon-wrapper"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Task"><i class="la la-tasks"></i></span></span>
                    
                  </span>
                </a>

              </li> -->
              <?php }?>

							<li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
								
								<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
									<span class="m-nav__link-icon">
										<span class="m-nav__link-icon-wrapper" onclick="show_calculator();"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Calculator"><i class="fa fa-calculator"></i></span></span>
										
									</span>
								</a>

							</li>
              <?php 
                  // $not_tot = get_notify_countByUser();
                  // $all_noti = get_notify_message();

               ?>
							<li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center   m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
                <a href="javascript:;" onclick="change_status();" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                <span class="m-nav__link-icon">
                <span class="m-nav__link-icon-wrapper"><i class="flaticon-alarm"></i></span>
                <span id="countspan"><?php if($not_tot != 0){ ?><span class="m-nav__link-badge m-badge m-badge--danger noti_count" id="badge"><?php echo $not_tot; ?></span><?php } ?></span>
                </span>
                </a>
                <div class="m-dropdown__wrapper" style="left: -71px !important">
                   <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                   <div class="m-dropdown__inner">
                      <div class="m-dropdown__body">
                         <div class="m-dropdown__content">
                           <div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
                                     <div class="m-list-timeline m-list-timeline--skin-light">
                                        <div class="m-list-timeline__items noti_li">
                                           <?php 
                                           if (count($all_noti) > 0) {
                                              $i=1; foreach ($all_noti as $noti) { 
                                              
                                              $noti_read = get_read_notify_message($_SESSION['admindata']['user_id'],$noti->notification_id);
                                              $cont = get_notification_content($noti);
                                              if($noti_read==0)
                                                 {
                                                    $rcolor = '#e6f2fe';
                                                 }
                                                 else
                                                 {
                                                    $rcolor = '';
                                                 }
                                                  ?>
                                           <div id="noti<?php echo $i;?>" style="cursor:pointer;background-color:<?php echo $rcolor; ?>;" class="m-list-timeline__item" onclick="read_single_notification(<?php echo $noti->notification_id;?>,<?php echo $i;?>);">
                                              <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                              <span class="m-list-timeline__text"><p><?php echo $cont; ?></p> </span>
                                              <span class="m-list-timeline__time"><?php echo time_elapsed_string_in_helper($noti->created_on); ?></span>
                                           </div>
                                        <?php $i++; } } else { ?>
                                          <div style="background-color:#fff;" class="m-list-timeline__item" >
                                              <p class="text-center" style="font-size: 15px;">Notification is Empty</p>
                                              <p class="text-center"><i class="fa fa-bell-slash" style="font-size: 20px;"></i></p>
                                           </div>
                                        <?php } ?>
                                        </div>
                                     </div>
                           </div>
                         </div>
                      </div>

                      <div class="m-dropdown__header m--align-center" style="border-top: 2px solid #ddd;">
                         <h5><span class="m-dropdown__header-subtitle"><a href="<?php echo base_url(); ?>Notifications/view_all_notification" style="color: #fff;">View All Notifications</a></span></h5>
                      </div>
                   </div>
                </div>
              </li>
							<li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
								<a href="#" class="m-nav__link m-dropdown__toggle">
									<span class="m-topbar__userpic">
										<img src="<?php echo $p_image; ?>" class="m--img-rounded m--marginless m--img-centered" alt="" />
									</span>
									<span class="m-nav__link-icon m-topbar__usericon  m--hide">
										<span class="m-nav__link-icon-wrapper"><i class="flaticon-user-ok"></i></span>
									</span>
									<span class="m-topbar__username m--hide">Nick</span>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__header m--align-center">
											<div class="m-card-user m-card-user--skin-light">
												<div class="m-card-user__pic">
													<img src="<?php echo $p_image; ?>" alt="<?php echo ucfirst($profile->name); ?>" />
												</div>
												<div class="m-card-user__details">
													<span class="m-card-user__name m--font-weight-500"><?php echo ucfirst($profile->name); ?></span>
												</div>
											</div>
										</div>
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<ul class="m-nav m-nav--skin-light">
													<li class="m-nav__section m--hide">
														<span class="m-nav__section-text">Section</span>
													</li>
													<li class="m-nav__item">
														<a href="<?php echo base_url(); ?>Profiles/" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-profile-1"></i>
															<span class="m-nav__link-title">
																<span class="m-nav__link-wrap">
																	<span class="m-nav__link-text">My Profile</span>
																</span>
															</span>
														</a>
													</li>
													<li class="m-nav__separator m-nav__separator--fit">
													</li>
													<li class="m-nav__item">
														<a href="<?php echo base_url(); ?>Login/logout" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
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

				<!-- END: Topbar -->
			</div>
		</div>
	</div>
</header>
<div id="mycalculator" style="display: none;">
  <div id="mycalculatorheader">Click here to move <span style="cursor: pointer;" class="pull-right" onclick="hide_calculator();"><i class="fa fa-times"></i></span></div>
  <div id="background"><!-- Main background -->    
    <div id="result"></div>
     <div id="main">
         <div id="first-rows">
          <button class="del-bg" id="delete">Del</button>
             <button value="%" class="btn-style operator opera-bg fall-back">%</button>
             <button value="+" class="btn-style opera-bg value align operator">+</button>
             </div>
             
           <div class="rows">
         <button value="7" class="btn-style num-bg numc first-child">7</button>
             <button value="8" class="btn-style num-bg numc">8</button>
             <button value="9" class="btn-style num-bg numc">9</button>
             <button value="-" class="btn-style opera-bg operator">-</button>
             </div>
             
             <div class="rows">
             <button value="4" class="btn-style num-bg numc first-child">4</button>
             <button value="5" class="btn-style num-bg numc">5</button>
             <button value="6" class="btn-style num-bg numc">6</button>
             <button value="*" class="btn-style opera-bg operator">x</button>
             </div>
             
             <div class="rows">
             <button value="1" class="btn-style num-bg numc first-child">1</button>
             <button value="2" class="btn-style num-bg numc">2</button>
             <button value="3" class="btn-style num-bg numc">3</button>
             <button value="/" class="btn-style opera-bg operator">/</button>
             </div>
             
             <div class="rows">
             <button value="0" class="num-bg zero" id="delete">0</button>
             <button value="." class="btn-style num-bg period fall-back">.</button>
             <button value="=" id="eqn-bg" class="eqn align">=</button>
             </div>
            
         </div>
     
     </div>
        
</div>

<?php }else{ ?>

         <!-- begin::Header -->
         <header id="m_header" class="m-grid__item m-header " m-minimize="minimize" m-minimize-offset="200" m-minimize-mobile-offset="200">
            <div class="m-header__top">
               <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                  <div class="m-stack m-stack--ver m-stack--desktop">

                     <!-- begin::Brand -->
                     <div class="m-stack__item m-brand">
                        <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                           <div class="m-stack__item m-stack__item--middle m-brand__logo">
                              <a href="<?php echo base_url(); ?>Leads" class="m-brand__logo-wrapper">
                                 <img alt="" src="<?php echo $p_logo; ?>" />
                              </a>
                           </div>
                           
                           <div class="m-stack__item m-stack__item--middle m-brand__tools">
                              <!-- begin::Responsive Header Menu Toggler-->
                              <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                 <span></span>
                              </a>

                              <!-- end::Responsive Header Menu Toggler-->

                              <!-- begin::Topbar Toggler-->
                              <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                 <i class="flaticon-more"></i>
                              </a>

                              <!--end::Topbar Toggler-->
                           </div>
                        </div>
                     </div>

                     <!-- end::Brand -->

                    <!-- BEGIN: Topbar -->
				<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-topbar__nav-wrapper">
						<ul class="m-topbar__nav m-nav m-nav--inline">
							<li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                
                <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                  <span class="m-nav__link-icon">
                    <span class="m-nav__link-icon-wrapper" onclick="show_calculator();"><i class="fa fa-calculator"></i></span>
                    
                  </span>
                </a>

              </li>
							<li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-right 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
								<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
									<span class="m-nav__link-icon">
										<span class="m-nav__link-icon-wrapper"><i class="flaticon-alarm"></i></span>
										<span class="m-nav__link-badge m-badge m-badge--danger">3</span>
									</span>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__header m--align-center">
											<span class="m-dropdown__header-title">9 New</span>
											<span class="m-dropdown__header-subtitle">User Notifications</span>
										</div>
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
													<li class="nav-item m-tabs__item">
														<a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
															Alerts
														</a>
													</li>
													<li class="nav-item m-tabs__item">
														<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_events" role="tab">Events</a>
													</li>
													<li class="nav-item m-tabs__item">
														<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_logs" role="tab">Logs</a>
													</li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
														<div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
															<div class="m-list-timeline m-list-timeline--skin-light">
																<div class="m-list-timeline__items">
																	<div class="m-list-timeline__item">
																		<span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
																		<span class="m-list-timeline__text">12 new users registered</span>
																		<span class="m-list-timeline__time">Just now</span>
																	</div>
																	<div class="m-list-timeline__item">
																		<span class="m-list-timeline__badge"></span>
																		<span class="m-list-timeline__text">System shutdown <span class="m-badge m-badge--success m-badge--wide">pending</span></span>
																		<span class="m-list-timeline__time">14 mins</span>
																	</div>
																	<div class="m-list-timeline__item">
																		<span class="m-list-timeline__badge"></span>
																		<span class="m-list-timeline__text">New invoice received</span>
																		<span class="m-list-timeline__time">20 mins</span>
																	</div>
																	<div class="m-list-timeline__item">
																		<span class="m-list-timeline__badge"></span>
																		<span class="m-list-timeline__text">DB overloaded 80% <span class="m-badge m-badge--info m-badge--wide">settled</span></span>
																		<span class="m-list-timeline__time">1 hr</span>
																	</div>
																	<div class="m-list-timeline__item">
																		<span class="m-list-timeline__badge"></span>
																		<span class="m-list-timeline__text">System error - <a href="#" class="m-link">Check</a></span>
																		<span class="m-list-timeline__time">2 hrs</span>
																	</div>
																	<div class="m-list-timeline__item m-list-timeline__item--read">
																		<span class="m-list-timeline__badge"></span>
																		<span href="" class="m-list-timeline__text">New order received <span class="m-badge m-badge--danger m-badge--wide">urgent</span></span>
																		<span class="m-list-timeline__time">7 hrs</span>
																	</div>
																	<div class="m-list-timeline__item m-list-timeline__item--read">
																		<span class="m-list-timeline__badge"></span>
																		<span class="m-list-timeline__text">Production server down</span>
																		<span class="m-list-timeline__time">3 hrs</span>
																	</div>
																	<div class="m-list-timeline__item">
																		<span class="m-list-timeline__badge"></span>
																		<span class="m-list-timeline__text">Production server up</span>
																		<span class="m-list-timeline__time">5 hrs</span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
														<div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
															<div class="m-list-timeline m-list-timeline--skin-light">
																<div class="m-list-timeline__items">
																	<div class="m-list-timeline__item">
																		<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																		<a href="" class="m-list-timeline__text">New order received</a>
																		<span class="m-list-timeline__time">Just now</span>
																	</div>
																	<div class="m-list-timeline__item">
																		<span class="m-list-timeline__badge m-list-timeline__badge--state1-danger"></span>
																		<a href="" class="m-list-timeline__text">New invoice received</a>
																		<span class="m-list-timeline__time">20 mins</span>
																	</div>
																	<div class="m-list-timeline__item">
																		<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																		<a href="" class="m-list-timeline__text">Production server up</a>
																		<span class="m-list-timeline__time">5 hrs</span>
																	</div>
																	<div class="m-list-timeline__item">
																		<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
																		<a href="" class="m-list-timeline__text">New order received</a>
																		<span class="m-list-timeline__time">7 hrs</span>
																	</div>
																	<div class="m-list-timeline__item">
																		<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
																		<a href="" class="m-list-timeline__text">System shutdown</a>
																		<span class="m-list-timeline__time">11 mins</span>
																	</div>
																	<div class="m-list-timeline__item">
																		<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
																		<a href="" class="m-list-timeline__text">Production server down</a>
																		<span class="m-list-timeline__time">3 hrs</span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
														<div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">
															<div class="m-stack__item m-stack__item--center m-stack__item--middle">
																<span class="">All caught up!<br>No new logs.</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
								<a href="#" class="m-nav__link m-dropdown__toggle">
									<span class="m-topbar__userpic">
										<img src="<?php echo $p_image; ?>" class="m--img-rounded m--marginless m--img-centered" alt="" />
									</span>
									<span class="m-nav__link-icon m-topbar__usericon  m--hide">
										<span class="m-nav__link-icon-wrapper"><i class="flaticon-user-ok"></i></span>
									</span>
									<span class="m-topbar__username m--hide">Nick</span>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__header m--align-center">
											<div class="m-card-user m-card-user--skin-light">
												<div class="m-card-user__pic">
													<img src="<?php echo $p_image; ?>" alt="<?php echo ucfirst($profile->name); ?>" />
												</div>
												<div class="m-card-user__details">
													<span class="m-card-user__name m--font-weight-500"><?php echo ucfirst($profile->name); ?></span>
												</div>
											</div>
										</div>
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<ul class="m-nav m-nav--skin-light">
													<li class="m-nav__section m--hide">
														<span class="m-nav__section-text">Section</span>
													</li>
													<li class="m-nav__item">
														<a href="<?php echo base_url(); ?>Profiles/" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-profile-1"></i>
															<span class="m-nav__link-title">
																<span class="m-nav__link-wrap">
																	<span class="m-nav__link-text">My Profile</span>
																</span>
															</span>
														</a>
													</li>
													<li class="m-nav__separator m-nav__separator--fit">
													</li>
													<li class="m-nav__item">
														<a href="<?php echo base_url(); ?>Login/logout" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
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

				<!-- END: Topbar -->
                  </div>
               </div>
            </div>
            <div class="m-header__bottom">
               <?php $this->load->view('common_horizontal_topbar'); ?>
            </div>
         </header>
         <div id="mycalculator" style="display: none;">
          <div id="mycalculatorheader">Click here to move <span style="cursor: pointer;" class="pull-right" onclick="hide_calculator();"><i class="fa fa-times"></i></span></div>
          <div id="background"><!-- Main background -->    
            <div id="result"></div>
             <div id="main">
                 <div id="first-rows">
                  <button class="del-bg" id="delete">Del</button>
                     <button value="%" class="btn-style operator opera-bg fall-back">%</button>
                     <button value="+" class="btn-style opera-bg value align operator">+</button>
                     </div>
                     
                   <div class="rows">
                     <button value="7" class="btn-style num-bg numc first-child">7</button>
                     <button value="8" class="btn-style num-bg numc">8</button>
                     <button value="9" class="btn-style num-bg numc">9</button>
                     <button value="-" class="btn-style opera-bg operator">-</button>
                     </div>
                     
                     <div class="rows">
                     <button value="4" class="btn-style num-bg numc first-child">4</button>
                     <button value="5" class="btn-style num-bg numc">5</button>
                     <button value="6" class="btn-style num-bg numc">6</button>
                     <button value="*" class="btn-style opera-bg operator">x</button>
                     </div>
                     
                     <div class="rows">
                     <button value="1" class="btn-style num-bg numc first-child">1</button>
                     <button value="2" class="btn-style num-bg numc">2</button>
                     <button value="3" class="btn-style num-bg numc">3</button>
                     <button value="/" class="btn-style opera-bg operator">/</button>
                     </div>
                     
                     <div class="rows">
                     <button value="0" class="num-bg zero" id="delete">0</button>
                     <button value="." class="btn-style num-bg period fall-back">.</button>
                     <button value="=" id="eqn-bg" class="eqn align">=</button>
                     </div>
                 </div>
             </div>  
         </div>
         <!-- end::Header -->

<?php } ?>
<!-- <script>
    var conn = new WebSocket('ws://localhost:8282');
    var client = {
        user_id: <?php // echo $_SESSION['admindata']['user_id']; ?>,
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
            // $('#messages').append(data.user_id + ' : ' + data.message + '<br>');
            console.log(data.user_id + ' : ' + data.message);
        }
        if (data.type === 'token') {
            // $('#token').html('JWT Token : ' + data.token);
            console.log('JWT Token : ' + data.token);
        }
    };

    $('#submit').click(function () {
        client.message = $('#text').val();
        client.token = $('#token').text().split(': ')[1];
        client.type = 'chat';
        if ($('#recipient_id').val()) {
            client.recipient_id = $('#recipient_id').val();
        }
        conn.send(JSON.stringify(client));
    });
</script> -->
<script>

  function change_status() 
  {      
    var nothid = $('#nothid').val()  
    if(nothid == 0)
    {
       $('#nothid').val(1); 
       
    }  
    else
    {
       $('#nothid').val(0);
    }          
    var base = "<?php echo base_url(); ?>";
    $.ajax({
        type: "POST",
        url: base+"Notifications/change_notification",
        success: function(response)
        {
         if(response == 1)
         {
            $('#badge').hide();
         }
        }
    });    
  }

  function open_task_page()
  {
    var task_page_url = '<?php echo base_url(); ?>task';
    window.open(
      task_page_url,
      '_blank' // <- This is what makes it open in a new window.
    );
  }
  function read_single_notification(nid,i) 
  {                    
    var base = "<?php echo base_url(); ?>";
    $.ajax({
       type: "POST",
       url: base+"Notifications/change_notification_read",
       async: false,
       type: "POST",
       data: "id="+nid,
       dataType: "html",
        success: function(response)
        {
          if(response == 1) {
            $("#noti"+i).css("background-color", "");
          }
        }
    });    
  }
  var conntop = new WebSocket('ws://localhost:8282');
  var client = {
      user_id: <?php echo $_SESSION['admindata']['user_id']; ?>,
      recipient_id: null,
      type: 'socket',
      token: null,
      message: null
  };

  conntop.onopen = function (e) {
      conntop.send(JSON.stringify(client));
      // $('#messages').append('<font color="green">Successfully connected as user ' + client.user_id + '</font><br>');
      console.log(client.user_id);
  };

  conntop.onmessage = function (e) {
      var data = JSON.parse(e.data);
      if (data.message) {
          $('.noti_li').prepend(data.message);countspan
          var current_noti_count_span = $('#countspan').text();
          if (current_noti_count_span.trim() != '') {
            $('#badge').show();
            var current_noti_count = $('#badge').text();
            $('#badge').html(parseInt(current_noti_count)+1);  
          }
          else {
            $('#countspan').append('<span class="m-nav__link-badge m-badge m-badge--danger noti_count" id="badge">1</span>');
          }
          
          console.log(data.user_id + ' : ' + data.message);
      }
      if (data.type === 'token') {
          // $('#token').html('JWT Token : ' + data.token);
          console.log('JWT Token : ' + data.token);
      }
  };
</script>