<?php $baseUrl=base_url();
    $user_id = $_SESSION['admindata']['user_id'];
    $profile = common_select_values('*', 'users', 'user_id = "'.$user_id.'"', 'row');

?>
<style>
  .pagination_cust_comment{
      padding:20px;
      user-select: none;
      
      
    }
   .pagination_cust_comment a{
        display:inline-block;
        padding:0 10px;
        cursor:pointer;
      }
      .pagination_cust_comment a:hover{
        display:inline-block;
        padding:0 10px;
        cursor:pointer;
        background:#dce5ff;
      }
      .pagination_cust_comment .disabled{
          opacity:.3;
          pointer-events: none;
          cursor:not-allowed;
      }
      .pagination_cust_comment .current {
        background:#dce5ff;
      }
</style>
<!--begin::Global Theme Bundle -->
<script src="<?php echo $baseUrl;?>assets/js/jquery-ui.js"></script>

<script src="<?php echo $baseUrl;?>assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/demo/demo12/base/scripts.bundle.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/demo/demo12/base/jasny-bootstrap.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/js/common_custom_functions.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/demo/demo12/custom/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/demo/demo12/custom/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/demo/demo12/custom/crud/datatables/advanced/multiple-controls.js" type="text/javascript"></script>
<!--end::Global Theme Bundle -->
<script src="<?php echo $baseUrl;?>assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/demo/demo12/custom/crud/forms/widgets/bootstrap-switch.js" type="text/javascript"></script>

<script src="<?php echo $baseUrl;?>assets/demo/demo12/custom/crud/forms/widgets/bootstrap-timepicker.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/demo/demo12/custom/crud/datatables/extensions/buttons.js" type="text/javascript"></script>

<script src="<?php echo $baseUrl;?>assets/demo/demo12/custom/crud/forms/widgets/select2.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/demo/demo12/custom/crud/forms/widgets/bootstrap-select.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/js/data.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/js/drilldown.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/js/funnel.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/js/accessibility.js" type="text/javascript"></script>

<script src="<?php echo $baseUrl; ?>assets/vendors/custom/colorpicker/js/bootstrap-colorpicker.min.js" type="text/javascript" class=""></script>
<script src="<?php echo $baseUrl; ?>assets/vendors/custom/colorpicker/js/color-picker.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl;?>assets/js/comboTreePlugin.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script type="text/javascript" src="<?php echo $baseUrl;?>assets/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
    $('.filemanager_iframe').fancybox({
        'width'  : 900,
        'height' : 500,
        'autoSize' : false,
        'type' : 'iframe',
        'autoScale' : true
    });
</script>
<script type="text/javascript">

$('#alertaddmessage').fadeIn().delay(3000).fadeOut();

var menu_show = '<?php echo $profile->show_menu; ?>';

if(menu_show == 0)
{
    $(document).ready(function() {
    var not_listed=0;
    $("#m_ver_menu a").each(function() {
        if (this.href == window.location.href) {
            //To find it has sub-menu
            if($(this).parent().parent().hasClass('m-menu__subnav')){
                $(this).parent().parent().parent().parent().addClass("m-menu__item--open"); // add active class to an anchor
                $(this).parent().parent().parent().parent().addClass("m-menu__item--expanded"); // add active class to an anchor
                 $(this).parent().parent().parent().parent().parent().parent().parent().addClass("m-menu__item--open"); // add active class to an anchor
                $(this).parent().parent().parent().parent().parent().parent().parent().addClass("m-menu__item--expanded"); // add active class to an anchor
                $(this).parent().parent().parent().parent().click(); // click the item to make it drop
            }
            else{
                
            }
            $(this).parent().addClass("m-menu__item--active"); // add active to li of the current link
            not_listed=1;
        }
    });
    //To set the active class for actions in menu list like add, edit & view
    if (not_listed==0) {
        var url = window.location.href;
        var split = url.split('/');
        // Ex URL: https:(0)/(1)/[domain_name](2)/[folder_name](3)/[menu_link](4)
        var check_url = split[0]+'/'+split[1]+'/'+split[2]+'/'+split[3]+'/'+split[4];
        $("#m_ver_menu a").each(function() {
            if (this.href == check_url) {
                //To find it has sub-menu
                if($(this).parent().parent().hasClass('m-menu__subnav')){
                    $(this).parent().parent().parent().parent().addClass("m-menu__item--open"); // add active class to an anchor
                    $(this).parent().parent().parent().parent().addClass("m-menu__item--expanded"); // add active class to an anchor
                    $(this).parent().parent().parent().parent().parent().parent().parent().addClass("m-menu__item--open"); // add active class to an anchor
                $(this).parent().parent().parent().parent().parent().parent().parent().addClass("m-menu__item--expanded"); // add active class to an anchor
                    $(this).parent().parent().parent().parent().click(); // click the item to make it drop
                }
                else{
                    
                }
                $(this).parent().addClass("m-menu__item--active"); // add active to li of the current link
            }
        });
    }
});

}
else{

$(document).ready(function() {
    var not_listed=0;
    $("#m_header_menu a").each(function() {
        if (this.href == window.location.href) {
            //To find it has sub-menu
            if($(this).parent().parent().hasClass('m-menu__subnav')){
                $(this).parent().parent().parent().parent().addClass("m-menu__item--active"); // add active class to an anchor
                $(this).parent().parent().parent().parent().parent().parent().parent().addClass("m-menu__item--active"); // add active class to an anchor
                $(this).parent().parent().parent().parent().click(); // click the item to make it drop
            }
            else{
                
            }
            $(this).parent().addClass("m-menu__item--active"); // add active to li of the current link
            not_listed=1;
        }
    });
    //To set the active class for actions in menu list like add, edit & view
    if (not_listed==0) {
        var url = window.location.href;
        var split = url.split('/');
        // Ex URL: https:(0)/(1)/[domain_name](2)/[folder_name](3)/[menu_link](4)
        var check_url = split[0]+'/'+split[1]+'/'+split[2]+'/'+split[3]+'/'+split[4];
        $("#m_ver_menu a").each(function() {
            if (this.href == check_url) {
                //To find it has sub-menu
                if($(this).parent().parent().hasClass('m-menu__subnav')){
                $(this).parent().parent().parent().parent().addClass("m-menu__item--active"); // add active class to an anchor
                $(this).parent().parent().parent().parent().parent().parent().parent().addClass("m-menu__item--active"); // add active class to an anchor
                    $(this).parent().parent().parent().parent().click(); // click the item to make it drop
                }
                else{
                    
                }
                $(this).parent().addClass("m-menu__item--active"); // add active to li of the current link
            }
        });
    }
});
}
</script>
<script type="text/javascript">
      $(document).ready(function() {
      // Animate loader off screen
      $(".se-pre-con").fadeOut("slow");;
   });
</script>

<script type="text/javascript">
   $('.kt_table_2').DataTable({responsive:!0,ordering:false});
   $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
         .columns.adjust()
         .responsive.recalc();
   });   

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
   
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});

//Make the DIV element draggagle:
dragElement(document.getElementById("mycalculator"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    /* if present, the header is where you move the DIV from:*/
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    /* otherwise, move the DIV from anywhere inside the DIV:*/
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
   $('#horizontal_scrollable').mousemove(function(e){
   
     // Find the width of all menu elements
     var totalWidth = 0;
      $(this).find('.hori_menu').each(function(i) {
         totalWidth += parseInt( $(this).outerWidth(), 10 );
      });

      // Find the cursor ratio and position the menu
     var l = (window.innerWidth - totalWidth) * e.pageX / (window.innerWidth-20);
      $(this).find('.hori_menu').css('transform','translateX('+ l + 'px)');
     
   });
   (function($) {
      var pagify = {
        items: {},
        container: null,
        totalPages: 1,
        perPage: 3,
        currentPage: 0,
        createNavigation: function() {
          this.totalPages = Math.ceil(this.items.length / this.perPage);

          $('.pagination_cust_comment', this.container.parent()).remove();
          var pagination = $('<div class="pagination_cust_comment"></div>').append('<a class="nav_pgi prev_pgi disabled" data-next="false"><</a>');

          for (var i = 0; i < this.totalPages; i++) {
            var pageElClass = "page";
            if (!i)
              pageElClass = "page current";
            var pageEl = '<a class="' + pageElClass + '" data-page="' + (
            i + 1) + '">' + (
            i + 1) + "</a>";
            pagination.append(pageEl);
          }
          pagination.append('<a class="nav_pgi next" data-next="true">></a>');

          this.container.after(pagination);

          var that = this;
          $("body").off("click", ".nav_pgi");
          this.navigator = $("body").on("click", ".nav_pgi", function() {
            var el = $(this);
            that.navigate(el.data("next"));
          });

          $("body").off("click", ".page");
          this.pageNavigator = $("body").on("click", ".page", function() {
            var el = $(this);
            that.goToPage(el.data("page"));
          });
        },
        navigate: function(next) {
          // default perPage to 5
          if (isNaN(next) || next === undefined) {
            next = true;
          }
          $(".pagination_cust_comment .nav_pgi").removeClass("disabled");
          if (next) {
            this.currentPage++;
            if (this.currentPage > (this.totalPages - 1))
              this.currentPage = (this.totalPages - 1);
            if (this.currentPage == (this.totalPages - 1))
              $(".pagination_cust_comment .nav_pgi.next").addClass("disabled");
            }
          else {
            this.currentPage--;
            if (this.currentPage < 0)
              this.currentPage = 0;
            if (this.currentPage == 0)
              $(".pagination_cust_comment .nav_pgi.prev_pgi").addClass("disabled");
            }

          this.showItems();
        },
        updateNavigation: function() {

          var pages = $(".pagination_cust_comment .page");
          pages.removeClass("current");
          $('.pagination_cust_comment .page[data-page="' + (
          this.currentPage + 1) + '"]').addClass("current");
        },
        goToPage: function(page) {

          this.currentPage = page - 1;

          $(".pagination_cust_comment .nav_pgi").removeClass("disabled");
          if (this.currentPage == (this.totalPages - 1))
            $(".pagination_cust_comment .nav_pgi.next").addClass("disabled");

          if (this.currentPage == 0)
            $(".pagination_cust_comment .nav_pgi.prev_pgi").addClass("disabled");
          this.showItems();
        },
        showItems: function() {
          this.items.hide();
          var base = this.perPage * this.currentPage;
          this.items.slice(base, base + this.perPage).show();

          this.updateNavigation();
        },
        init: function(container, items, perPage) {
          this.container = container;
          this.currentPage = 0;
          this.totalPages = 1;
          this.perPage = perPage;
          this.items = items;
          this.createNavigation();
          this.showItems();
        }
      };

      // stuff it all into a jQuery method!
      $.fn.pagify = function(perPage, itemSelector) {
        var el = $(this);
        var items = $(itemSelector, el);

        // default perPage to 5
        if (isNaN(perPage) || perPage === undefined) {
          perPage = 3;
        }

        // don't fire if fewer items than perPage
        if (items.length <= perPage) {
          return true;
        }

        pagify.init(el, items, perPage);
      };
    })(jQuery);

    $.fn.dataTable.ext.errMode = 'none'; 

    function check_user_is_active_or_not()
    {
      var user_last_active_time = '<?php echo $_SESSION['user_last_active_time']; ?>';
      var current_time = '<?php echo date('Y-m-d H:i:s'); ?>';
      var minimum_inactive_time = '1';
    }
</script>

<!--end::Web font -->