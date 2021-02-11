<style>
.table-wrapper {
    overflow-x: scroll;
    /*width: 600px;*/
    margin: 0 auto;
}
</style>
<div class="row"> 
   <div class="col-lg-12 table-wrapper">  
      <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
         <thead>
            <tr>
               <th>S.No</th>
               <th>Month</th>
               <th>Inv No</th>
               <th>PFI No</th>
               <th>Brand</th>
               <th>Inv in FOREX</th>
               <th>FOB in INR</th>
               <th>MEIS</th>
               <th>Draw Back</th>
               <th>Contribution</th>
               <th>Total Contribution</th>
               <th>% OF Profit At COGS</th>
            </tr>
         </thead>

         <tbody>
               <?php $date_format =common_date_format(); $i=1;$foxtot=$fobtot=$meistot=$dbtot=$contritot=$tcontritot=$pocogstot=0;foreach($buyer_order_list as $bolist){
                  $boinvval = $this->Benefitsheet_model->get_buyer_order_invoice_value($bolist['buyer_order_id']);
                  $bofobval = $this->Benefitsheet_model->get_buyer_order_fob_value($bolist['buyer_order_id']);
                  $buyer_order_product_list = $this->Benefitsheet_model->get_buyer_order_product_by_id($bolist['buyer_order_id']);
                  $bobenefit = $this->Buyerorder_model->get_buyer_order_benefit($bolist['buyer_order_id']);
                  if(count($bobenefit)>0)
                  {
                     $tpurval = 0;
                     $buyer_order_benefit_details = $this->Buyerorder_model->get_buyer_order_benefit_details($bobenefit->buyer_order_benefit_id);
                     foreach($buyer_order_benefit_details as $bobd){
                        $tpurval+=$bobd['total_pur_value'];
                     }
                  }
                  else
                  {
                     $tpurval=0;
                  }

                  if(count($boinvval)>0)
                  {
                     $forex = $boinvval->input_field;
                  }
                  else
                  {
                     $forex = 0;
                  }

                  if(count($bofobval)>0)
                  {
                     $fobinv = $bofobval->input_field;
                  }
                  else
                  {
                     $fobinv = 0;
                  }
                  $meis = $bobenefit->meis?$bobenefit->meis:'0';
                  $drawback = $bobenefit->drawback?$bobenefit->drawback:'0';
                  $contri = $bobenefit->contribution?$bobenefit->contribution:'0';
                  $tcontri = $meis + $drawback + $contri;

                  if($tpurval>0)
                  {
                     $pofcogs = ($tcontri/$tpurval)*100;
                  }
                  else
                  {
                     $pofcogs = 0;
                  }

                  $bdate = explode('-',date($date_format, strtotime($bolist['invoice_date'])));
                  $monthName = date('M', mktime(0, 0, 0, $bdate[1], 10));

                  ?>
                  <tr>
                     <td><?php echo $i;?></td>
                     <td><?php echo $monthName; ?></td>
                     <td><?php echo $bolist['buyer_order_invoice_no']; ?></td>
                     <td><?php echo $bolist['proforma_invoice_no']; ?></td>
                     <td><?php echo $bolist['company_name'].', '.$bolist['country_name'].' - '.$buyer_order_product_list->industry_name; ?></td>
                     <td><span class="pull-right"><?php echo number_format($forex,2);?></span></td>
                     <td><span class="pull-right"><?php echo number_format($fobinv,2);?></span></td>
                     <td><span class="pull-right"><?php echo number_format($meis,2);?></span></td>
                     <td><span class="pull-right"><?php echo number_format($drawback,2);?></span></td>
                     <td><span class="pull-right"><?php echo number_format($contri,2);?></span></td>
                     <td><span class="pull-right"><?php echo number_format($tcontri,2);?></span></td>
                     <td><span class="pull-right"><?php echo number_format($pofcogs,2);?></span></td>
                  </tr>
               <?php $i++;$foxtot+=$forex;$fobtot+=$fobinv;$meistot+=$meis;$dbtot+=$drawback;$contritot+=$contri;$tcontritot+=$tcontri;$pocogstot+=$pofcogs;}?>
         </tbody>
         <tfoot>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td><span class="pull-right"><b><?php echo number_format($foxtot,2);?></b></span></td>
               <td><span class="pull-right"><b><?php echo number_format($fobtot,2);?></b></span></td>
               <td><span class="pull-right"><b><?php echo number_format($meistot,2);?></b></span></td>
               <td><span class="pull-right"><b><?php echo number_format($dbtot,2);?></b></span></td>
               <td><span class="pull-right"><b><?php echo number_format($contritot,2);?></b></span></td>
               <td><span class="pull-right"><b><?php echo number_format($tcontritot,2);?></b></span></td>
               <td><span class="pull-right"><b><?php echo number_format($pocogstot,2);?></b></span></td>
            </tr>
         </tfoot>
      </table>
   </div>
</div>