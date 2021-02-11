<div class="row">
   <div class="col-lg-12">
      <?php foreach($followup_stage as $fstage){?>
         <div class="col-lg-2">
            <span class="lead_source_color" style="background-color: <?php echo $fstage['stage_color']; ?>;"></span><?php echo $fstage['followup_sheet_stage']; ?>
         </div>
      <?php }?>
   </div>
</div>
<br>
<div class="row"> 
   <div class="col-lg-12">  
      <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
         <thead>
            <tr>
               <th>Category</th>
               <?php foreach($bolist as $blist){?>
                  <th><?php echo $blist['buyer_order_invoice_no'];?></th>
               <?php }?>
            </tr>
         </thead>

         <tbody>
               <tr>
                  <td>DOCUMENT NO</td>
                  <?php foreach($bolist as $blist){
                     if($stg=='')
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='DOCUMENT NO'")->row();
                     else
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='DOCUMENT NO' AND FIND_IN_SET(bofs.followup_sheet_stage_id,'$stg')")->row();
                     ?>
                     <?php if(count($fuplist)>0){?>
                        <td style="background-color:<?php echo $fuplist->stage_color;?>"> <?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                     <?php }else{?>
                        <td></td>
                     <?php }?>
                  <?php }?>
               </tr>
               <tr>
                  <td>Buyer Name</td>
                  <?php foreach($bolist as $blist){
                     if($stg=='')
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='Buyer Name'")->row();
                     else
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='Buyer Name' AND FIND_IN_SET(bofs.followup_sheet_stage_id,'$stg')")->row();
                     ?>
                     <?php if(count($fuplist)>0){?>
                        <td style="background-color:<?php echo $fuplist->stage_color;?>"> <?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                     <?php }else{?>
                        <td></td>
                     <?php }?>
                  <?php }?>
               </tr>
               <tr>
                  <td>PORT OF LOADING</td>
                  <?php foreach($bolist as $blist){
                     if($stg == '')
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='PORT OF LOADING'")->row();
                     else
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='PORT OF LOADING' AND FIND_IN_SET(bofs.followup_sheet_stage_id,'$stg')")->row();
                     ?>
                     <?php if(count($fuplist)>0){?>
                        <td style="background-color:<?php echo $fuplist->stage_color;?>"> <?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                     <?php }else{?>
                        <td></td>
                     <?php }?>
                  <?php }?>
               </tr>
               <tr>
                  <td>SEA / AIRPORT - COUNTRY</td>
                  <?php foreach($bolist as $blist){
                     if($stg=='')
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='SEA / AIRPORT - COUNTRY'")->row();
                     else                        
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='SEA / AIRPORT - COUNTRY' AND FIND_IN_SET(bofs.followup_sheet_stage_id,'$stg')")->row();
                     ?>
                     <?php if(count($fuplist)>0){?>
                        <td style="background-color:<?php echo $fuplist->stage_color;?>"> <?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                     <?php }else{?>
                        <td></td>
                     <?php }?>
                  <?php }?>
               </tr>
               <tr>
                  <td>PROFORMA INVOICE</td>
                  <?php foreach($bolist as $blist){
                     if($stg=='')
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='PROFORMA INVOICE'")->row();
                     else
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='PROFORMA INVOICE' AND FIND_IN_SET(bofs.followup_sheet_stage_id,'$stg')")->row();
                     ?>
                     <?php if(count($fuplist)>0){?>
                        <td style="background-color:<?php echo $fuplist->stage_color;?>"> <?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                     <?php }else{?>
                        <td></td>
                     <?php }?>
                  <?php }?>
               </tr>
               <tr>
                  <td>OUR PURCHASE ORDER NO</td>
                  <?php foreach($bolist as $blist){
                     if($stg=='')
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='OUR PURCHASE ORDER NO'")->row();
                     else
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='OUR PURCHASE ORDER NO' AND FIND_IN_SET(bofs.followup_sheet_stage_id,'$stg')")->row();
                     ?>
                     <?php if(count($fuplist)>0){?>
                        <td style="background-color:<?php echo $fuplist->stage_color;?>"> <?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                     <?php }else{?>
                        <td></td>
                     <?php }?>
                  <?php }?>
               </tr>
               <tr>
                  <td>SUPPLIER</td>
                  <?php foreach($bolist as $blist){
                     if($stg=='')
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='SUPPLIER'")->row();
                     else
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='SUPPLIER' AND FIND_IN_SET(bofs.followup_sheet_stage_id,'$stg')")->row();
                     ?>
                     <?php if(count($fuplist)>0){?>
                        <td style="background-color:<?php echo $fuplist->stage_color;?>"> <?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                     <?php }else{?>
                        <td></td>
                     <?php }?>
                  <?php }?>
               </tr>
               <tr>
                  <td>PAYMENT TERMS</td>
                  <?php foreach($bolist as $blist){
                     if($stg=='')
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='PAYMENT TERMS'")->row();
                     else
                        $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.automatic_field='PAYMENT TERMS' AND FIND_IN_SET(bofs.followup_sheet_stage_id,'$stg')")->row();
                     ?>
                     <?php if(count($fuplist)>0){?>
                        <td style="background-color:<?php echo $fuplist->stage_color;?>"> <?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                     <?php }else{?>
                        <td></td>
                     <?php }?>
                  <?php }?>
               </tr>

               <?php foreach($followup_sheet_category_list as $fsclist){?>
                  <tr>
                     <td><?php echo $fsclist['followup_sheet_category'];?></td>                     
                     <?php foreach($bolist as $blist){
                        if($stg=='')
                           $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color,fsc.input_type FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss,followup_sheet_category fsc WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.followup_sheet_category_id = fsc.followup_sheet_category_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.followup_sheet_category_id='".$fsclist['followup_sheet_category_id']."'")->row();
                        else
                           $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color,fsc.input_type FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss,followup_sheet_category fsc WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.followup_sheet_category_id = fsc.followup_sheet_category_id AND bofs.buyer_order_id = '".$blist['buyer_order_id']."' AND bofs.followup_sheet_category_id='".$fsclist['followup_sheet_category_id']."' AND FIND_IN_SET(bofs.followup_sheet_stage_id,'$stg')")->row();
                        ?>
                        <?php if(count($fuplist)>0){
                         if($fuplist->input_type == 0){?>
                              <td style="background-color:<?php echo $fuplist->stage_color;?>"> <?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                           <?php }else{?>
                              <td style="background-color:<?php echo $fuplist->stage_color;?>"> <?php echo $fuplist->input_field==1?'Yes':'No';?><br><br> <?php echo $fuplist->remarks;?></td>
                           <?php }
                           }else{?>
                           <td></td>
                        <?php }?>
                     <?php }?>
                  </tr>
               <?php }?>
         </tbody>
      </table>
   </div>
</div>