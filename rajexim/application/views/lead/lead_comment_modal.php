<style>

.chat-search-box {
    -webkit-border-radius: 3px 0 0 0;
    -moz-border-radius: 3px 0 0 0;
    border-radius: 3px 0 0 0;
    padding: .75rem 1rem;
}

.chat-search-box .input-group .form-control {
    -webkit-border-radius: 2px 0 0 2px;
    -moz-border-radius: 2px 0 0 2px;
    border-radius: 2px 0 0 2px;
    border-right: 0;
}

.chat-search-box .input-group .form-control:focus {
    border-right: 0;
}

.chat-search-box .input-group .input-group-btn .btn {
    -webkit-border-radius: 0 2px 2px 0;
    -moz-border-radius: 0 2px 2px 0;
    border-radius: 0 2px 2px 0;
    margin: 0;
}

.chat-search-box .input-group .input-group-btn .btn i {
    font-size: 1.2rem;
    line-height: 100%;
    vertical-align: middle;
}

@media (max-width: 767px) {
    .chat-search-box {
        display: none;
    }
}


/************************************************
  ************************************************
                  Users Container
  ************************************************
************************************************/

.users-container {
    position: relative;
    padding: 1rem 0;
    border-right: 1px solid #e6ecf3;
    height: 100%;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
}


/************************************************
  ************************************************
                      Users
  ************************************************
************************************************/

.users {
    padding: 0;
}

.users .person {
    position: relative;
    width: 100%;
    padding: 10px 1rem;
    cursor: pointer;
    border-bottom: 1px solid #f0f4f8;
}

.users .person:hover {
    background-color: #ffffff;
    /* Fallback Color */
    background-image: -webkit-gradient(linear, left top, left bottom, from(#e9eff5), to(#ffffff));
    /* Saf4+, Chrome */
    background-image: -webkit-linear-gradient(right, #e9eff5, #ffffff);
    /* Chrome 10+, Saf5.1+, iOS 5+ */
    background-image: -moz-linear-gradient(right, #e9eff5, #ffffff);
    /* FF3.6 */
    background-image: -ms-linear-gradient(right, #e9eff5, #ffffff);
    /* IE10 */
    background-image: -o-linear-gradient(right, #e9eff5, #ffffff);
    /* Opera 11.10+ */
    background-image: linear-gradient(right, #e9eff5, #ffffff);
}

.users .person.active-user {
    background-color: #ffffff;
    /* Fallback Color */
    background-image: -webkit-gradient(linear, left top, left bottom, from(#f7f9fb), to(#ffffff));
    /* Saf4+, Chrome */
    background-image: -webkit-linear-gradient(right, #f7f9fb, #ffffff);
    /* Chrome 10+, Saf5.1+, iOS 5+ */
    background-image: -moz-linear-gradient(right, #f7f9fb, #ffffff);
    /* FF3.6 */
    background-image: -ms-linear-gradient(right, #f7f9fb, #ffffff);
    /* IE10 */
    background-image: -o-linear-gradient(right, #f7f9fb, #ffffff);
    /* Opera 11.10+ */
    background-image: linear-gradient(right, #f7f9fb, #ffffff);
}

.users .person:last-child {
    border-bottom: 0;
}

.users .person .user {
    display: inline-block;
    position: relative;
    margin-right: 10px;
}

.users .person .user img {
    width: 48px;
    height: 48px;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
}

.users .person .user .status {
    width: 10px;
    height: 10px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
    background: #e6ecf3;
    position: absolute;
    top: 0;
    right: 0;
}

.users .person .user .status.online {
    background: #9ec94a;
}

.users .person .user .status.offline {
    background: #c4d2e2;
}

.users .person .user .status.away {
    background: #f9be52;
}

.users .person .user .status.busy {
    background: #fd7274;
}

.users .person p.name-time {
    font-weight: 600;
    font-size: .85rem;
    display: inline-block;
}

.users .person p.name-time .time {
    font-weight: 400;
    font-size: .7rem;
    text-align: right;
    color: #8796af;
}

@media (max-width: 767px) {
    .users .person .user img {
        width: 30px;
        height: 30px;
    }
    .users .person p.name-time {
        display: none;
    }
    .users .person p.name-time .time {
        display: none;
    }
}


/************************************************
  ************************************************
                  Chat right side
  ************************************************
************************************************/

.selected-user {
    width: 100%;
    padding: 0 15px;
    min-height: 64px;
    line-height: 64px;
    border-bottom: 1px solid #e6ecf3;
    -webkit-border-radius: 0 3px 0 0;
    -moz-border-radius: 0 3px 0 0;
    border-radius: 0 3px 0 0;
}

.selected-user span {
    line-height: 100%;
}

.selected-user span.name {
    font-weight: 700;
}

.chat-container {
    position: relative;
    padding: 1rem;
    width: 100%;
}

.chat-container li.chat-left,
.chat-container li.chat-right {
    display: flex;
    flex: 1;
    flex-direction: row;
    margin-bottom: 40px;
}

.chat-container li img {
    width: 48px;
    height: 48px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
}

.chat-container li .chat-avatar {
    margin-right: 20px;
}

.chat-container li.chat-right {
    justify-content: flex-end;
}

.chat-container li.chat-right > .chat-avatar {
    margin-left: 20px;
    margin-right: 0;
}

.chat-container li .chat-name {
    font-size: .75rem;
    color: #999999;
    text-align: center;
}

.chat-container li .chat-text {
    padding: .4rem 1rem;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    background: #ffffff;
    font-weight: 300;
    line-height: 150%;
    position: relative;
    max-width: 510px;
}

.chat-container li .chat-text:before {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    top: 10px;
    left: -20px;
    border: 10px solid;
    border-color: transparent #ffffff transparent transparent;
}

.chat-container li.chat-right > .chat-text {
    text-align: right;
    max-width: 510px;
}

.chat-container li.chat-right > .chat-text:before {
    right: -20px;
    border-color: transparent transparent transparent #ffffff;
    left: inherit;
}

.chat-container li .chat-hour {
    padding: 0;
    margin-bottom: 10px;
    font-size: .75rem;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    margin: 0 0 0 15px;
}

.chat-container li .chat-hour > span {
    font-size: 16px;
    color: #9ec94a;
}

.chat-container li.chat-right > .chat-hour {
    margin: 0 15px 0 0;
}

@media (max-width: 767px) {
    .chat-container li.chat-left,
    .chat-container li.chat-right {
        flex-direction: column;
        margin-bottom: 30px;
    }
    .chat-container li img {
        width: 32px;
        height: 32px;
    }
    .chat-container li.chat-left .chat-avatar {
        margin: 0 0 5px 0;
        display: flex;
        align-items: center;
    }
    .chat-container li.chat-left .chat-hour {
        justify-content: flex-end;
    }
    .chat-container li.chat-left .chat-name {
        margin-left: 5px;
    }
    .chat-container li.chat-right .chat-avatar {
        order: -1;
        margin: 0 0 5px 0;
        align-items: center;
        display: flex;
        justify-content: right;
        flex-direction: row-reverse;
    }
    .chat-container li.chat-right .chat-hour {
        justify-content: flex-start;
        order: 2;
    }
    .chat-container li.chat-right .chat-name {
        margin-right: 5px;
    }
    .chat-container li .chat-text {
        font-size: .8rem;
    }
}

.chat-form {
    padding: 15px;
    width: 100%;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ffffff;
    border-top: 1px solid white;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
.card {
    border: 0;
    background: #f4f5fb;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    margin-bottom: 2rem;
    box-shadow: none;
}
ul#comments_block {
    max-height: 200px;
    overflow-y: scroll;
}
</style>
<div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel"><?php echo (isset($view_from)) ? $view_from : ''; ?> Comments </h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body" style="padding: 0px;">
         <?php if (count($lead_comments_list)>0){ ?>
            <div class="row">
               <div class="col-md-9"></div>
               <div class="col-md-3">
                  
               </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <br>
                  <div class="row page-header">
                     <div class="col-md-3"> <h5 style="padding-left: 15px;padding-top: 13px;"><?php echo count($lead_comments_list); ?> Comment<?php echo(count($lead_comments_list) == 1) ? '' : 's' ?></h5> </div>
                     <div class="col-md-6"></div>
                     <div class="col-md-3">
                        <input type="text" id="search_in_comment" class="form-control" placeholder="Search in Comments" style="margin-bottom: 8px;width: 161px;">
                     </div>
                  </div> 
                  <div class="container">
                      <div class="content-wrapper">

                          <div class="row gutters">

                              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                  <div class="card m-0">

                                      <!-- Row start -->
                                      <div class="row no-gutters">
                                             
                                              <div class="chat-container">
                                                  <ul class="chat-box chatContainerScroll" id="comments_block">
                                                   <?php foreach($lead_comments_list as $botlist){ 
                                                      if($_SESSION['admindata']['user_id'] != $botlist['created_by']) {
                                                      ?>
                                                      <li class="chat-left each_comments_blocks">
                                                          <div class="chat-avatar">
                                                              <img src="<?php echo base_url(); ?>assets/user_profile/<?php echo ($botlist['profile_image'] == '') ? 'default.png' : $botlist['profile_image']; ?>">
                                                              <div class="chat-name"><?php echo $botlist['name'];?></div>
                                                          </div>
                                                          <div class="chat-text"><?php echo $botlist['comments'];?></div>
                                                          <div class="chat-hour"><?php echo time_elapsed_string_in_helper($botlist['created_on']);?> <span class="fa fa-check-circle"></span></div>
                                                      </li>
                                                      <?php } else { ?>
                                                      <li class="chat-right each_comments_blocks">
                                                          <div class="chat-hour"><?php echo time_elapsed_string_in_helper($botlist['created_on']);?> <span class="fa fa-check-circle"></span></div>
                                                          <div class="chat-text"><?php echo $botlist['comments'];?></div>
                                                          <div class="chat-avatar">
                                                              <img src="<?php echo base_url(); ?>assets/user_profile/<?php echo ($botlist['profile_image'] == '') ? 'default.png' : $botlist['profile_image']; ?>">
                                                              <div class="chat-name"><?php echo $botlist['name'];?></div>
                                                          </div>
                                                      </li>
                                                   <?php } } ?>
                                                  </ul>
                                                  
                                              </div>
                                          
                                      </div>
                                      <!-- Row end -->
                                  </div>

                              </div>

                          </div>
                          <!-- Row end -->

                      </div>
                      <!-- Content wrapper end -->

                  </div>
                 <!--  <div class="comments-list" id="comments_block">

                     <?php foreach($lead_comments_list as $botlist){ ?>
                       <div class="media each_comments_blocks" style="margin-top: 2px; <?php if($_SESSION['admindata']['user_id'] == $botlist['created_by']) { ?> background: #f3f6ff; <?php } ?>" >
                           
                            <a class="media-left" href="#">
                              <img src="<?php echo base_url(); ?>assets/user_profile/<?php echo ($botlist['profile_image'] == '') ? 'default.png' : $botlist['profile_image']; ?>" height="40" width="40" style="border-radius: 50%;">
                            </a>
                            <div class="media-body">
                                
                              <h4 class="media-heading user_name"><?php echo $botlist['name'];?></h4>
                              <?php echo $botlist['comments'];?>
                              
                             
                            </div>
                            <p class="pull-right"><small><?php echo time_elapsed_string_in_helper($botlist['created_on']);?></small></p>
                        </div>
                        <?php } ?>
                  </div> -->
                    
                    
                    
                </div>
            </div>
      
       <?php } ?>
         <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="POST" action="<?php echo base_url(); ?>leads/<?php echo ($view_from == "Opportunity") ? 'create_oppo_comments' : 'create_lead_comments'; ?>">
            <input type="hidden" name="comment_add_from" value="<?php echo $view_from; ?>">
          <input type="hidden" id="lead_id" name="lead_id" value="<?php echo $lead_id;?>">
            <div class="row" style="padding: 15px;">
              <div class="col-lg-12">
                <label>Enter Your Comments Here<span class="text-danger">*</span></label>
                <textarea rows="3" id="comments" name="comments" class="form-control m-input" placeholder="Comments..."></textarea>
                <span id="comments_err" class="text-danger"></span>
              </div>
            </div>
            <br>
            
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="lead_comment_validation();" id="add_wl_btn" class="btn btn-primary">Add Comment</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      
   </div>
</div>
<script>
$(document).ready(function(){
  $("#search_in_comment").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#comments_block .each_comments_blocks").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  // $("#comments_block").pagify(6, ".each_comments_blocks");
});   

function lead_comment_validation(){
    var err = 0;
      var cmnts = $('#comments').val();

      if(cmnts==''){
         $('#comments_err').html('Enter Comments');
         err++;
      }else{
        $('#comments_err').html('');
      }


  if(err>0){ return false; }else{ $('#m_form').submit(); return true;  }
}
</script>