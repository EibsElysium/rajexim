<?php 
 	$g_settings = common_select_values('*', 'general_settings', '', 'row');
 	$p_title = isset($g_settings->product_title) ? $g_settings->product_title : 'Raj Exim';
 	$p_logo  = isset($g_settings->product_logo) ? base_url().'assets/common_images/'.$g_settings->product_logo : base_url().'assets/common_images/logo.png';
 	$p_favicon  = isset($g_settings->favicon) ? base_url().'assets/common_images/'.$g_settings->favicon : base_url().'assets/images/favicon.ico';
?>
 <!-- begin::Footer -->
 <!-- <footer class="m-grid__item m-footer">
    <div class="m-container m-container--fluid m-container--full-height m-page__container">
       <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
          <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last text-center">
             <span class="m-footer__copyright">
             <?php //echo date('Y'); ?> &copy; <a href="https://rajexim.com/" class="m-link" target="_blank"><?php //echo $p_title; ?></a>
             </span>
          </div>
           <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
             <span class="m-footer__copyright">
             Designed By <b><a href="https://eibsglobal.com/" target="_blank" title="Web Design Madurai - Custom Portal Development" style="color:#3d2288;font-size:16px;">E<span style="color:#ff5e00;">i</span>BS</a></b>
             </span>
          </div> 
       </div>
    </div>
 </footer> -->
 <?php $ip = $_SERVER['REMOTE_ADDR'];?>
<?php $executionTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];?>
<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// $txt = "[".date('Y-m-d H:i:s')."] => ".$ip."  -  ".$actual_link."  -  ".$executionTime."  -  MEM : ".fget_server_memory_usage()."  -  CPU : ".fget_server_cpu_usage();
$txt = "[".date('Y-m-d H:i:s')."] => ".$ip."  -  ".$actual_link."  -  ".$executionTime;


$mostRecentFilePath = "";
$mostRecentFileMTime = 0;

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("Logs/Execution Logs"), RecursiveIteratorIterator::CHILD_FIRST);
foreach ($iterator as $fileinfo) {
    if ($fileinfo->isFile()) {
        if ($fileinfo->getMTime() > $mostRecentFileMTime) {
            $mostRecentFileMTime = $fileinfo->getMTime();
            $mostRecentFilePath = $fileinfo->getPathname();
        }
    }
}

$fsize = filesize($mostRecentFilePath);
if($fsize>1000000)
  $myfile = file_put_contents('Logs/Execution Logs/execution_log-'.date("Y-m-d").'.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
else
    $myfile = file_put_contents($mostRecentFilePath, $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
?>
 <!-- end::Footer -->

<!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>
<!-- end::Scroll Top -->
<?php $this->load->view('common_js'); ?>
