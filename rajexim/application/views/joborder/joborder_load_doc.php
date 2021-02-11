<link href="<?php echo base_url();?>assets/demo/demo12/fileuploader/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<div class="modal-dialog modal-lg cust_modal" role="document">
	       <div class="modal-content">
	          <div class="modal-header">
	             <h5 class="modal-title" id="exampleModalLabel">Loading Document - <?php echo $joborder_list->job_order_no;?></h5>
	             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	             <span aria-hidden="true">&times;</span>
	             </button>
	          </div>
	          <?php 
	          $abspath = getcwd();
				$filecount = 0;
				$jo_folder_path = str_replace('/', '-', $joborder_list->job_order_no)."/";
				$baseFileLocation = '/assets/joborder/'.$jo_folder_path;

		        $loading_type = $this->Joborder_model->get_active_loading_type();
		        ?>
	          <div class="modal-body">
	          	<?php foreach($loading_type as $ltype){
	          		$files = glob($abspath.$baseFileLocation.$ltype['loading_type'].'/' . "*");
			        if ($files){
			         $filecount = count($files);
			        }
			        else
			        {
			          $filecount=0;
			        }

			        if($filecount>0)
			        {
	          		?>
	          		
	          		<fieldset>
	          			<legend class="text-info"><b><?php echo $ltype['loading_type'];?></b></legend>
			          	<div class="row">
			          		<?php for($i=1;$i<=$filecount;$i++){?>
			          		<div class="col-lg-3" style="margin:0 auto;text-align:center;">
			          			<div class="form-group">
									<a class="fancybox" href="<?php echo base_url().$baseFileLocation.$ltype['loading_type'];?>/photo_<?php echo $i;?>.jpg" data-fancybox-group="gallery" title="<?php echo $ltype['loading_type'].' - Photo_'.$i;?>" ><img class="img-responsive" src="<?php echo base_url().$baseFileLocation.$ltype['loading_type'];?>/photo_<?php echo $i;?>.jpg" alt="Photo <?php echo $i;?>" width="100%" height="150" style="object-fit:cover;" /></a>
								</div>
							</div>
							<?php }?>
		          		</div>
		          	</fieldset>
          		<?php }
          			}?>
	          	</div>
	          <div class="modal-footer">
	             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	          </div>
	       </div>
	    </div>


<script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/jquery.fancybox.pack.js" type="text/javascript"></script>
<script>

$(document).ready(function() {
$('.fancybox').fancybox();
});

</script>	    