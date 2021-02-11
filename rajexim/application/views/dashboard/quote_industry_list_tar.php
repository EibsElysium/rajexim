<table class="table table-striped- table-bordered table-checkable m-table m-table--head-bg-theme usage_cost4" width="100%">
 <thead>
    <tr>
       <th data-orderable="false">Product</th>
       <th data-orderable="false">Target</th>
       <th data-orderable="false">Q1</th>
       <th data-orderable="false">Q2</th>
       <th data-orderable="false">Q3</th>
       <th data-orderable="false">Q4</th>
       <th data-orderable="false">Achieved</th>
       <th data-orderable="false">Balance</th>
       
    </tr>
 </thead>
 <tbody>
  <?php $i=0; $date_format =common_date_format();$balance=$whole_tar_tot_count=$q1cc=$q2cc=$q3cc=$q4cc=$balancec=$tcountc=0;foreach ($user_products_list as $qlist){
    $yr = explode('-', $fy);

    $q1fdate = $yr[0].'-04-01';
    $q1tdate = $yr[0].'-06-30';

    $q2fdate = $yr[0].'-07-01';
    $q2tdate = $yr[0].'-09-30';

    $q3fdate = $yr[0].'-10-01';
    $q3tdate = $yr[0].'-12-31';

    $q4fdate = $yr[1].'-01-01';
    $q4tdate = $yr[1].'-03-31';

    $q1c=$q2c=$q3c=$q4c=$tcount=0;
    if ($quid != '') {
      $quid_query = "AND l.lead_assigned_to = '$quid'";
    }
    else {
      $quid_query = ""; 
    }
    $q1quotelist = $this->db->query("SELECT q.*,max(q.quote_id) as qid FROM quote q LEFT JOIN leads l ON l.lead_id = q.lead_id LEFT JOIN proforma_invoice pi ON pi.quote_id = q.quote_id WHERE q.lead_id = l.lead_id AND q.quote_id = pi.quote_id AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$q1fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$q1tdate."', '%Y-%m-%d') $quid_query AND q.status=0 GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

    if(count($q1quotelist)>0)
    {
      foreach($q1quotelist as $q1list)
      {
        $quote1prodindus = $this->db->query("SELECT qp.*, i.industry_name FROM `quote_product` qp,product_items pi,products p, industries i WHERE qp.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND p.industry_id = i.industry_id AND qp.quote_id = '".$q1list['qid']."' AND p.product_id = '".$qlist->product_id."' ")->result_array();
        $q1c+=count($quote1prodindus);
      }
    }

    $q2quotelist = $this->db->query("SELECT q.*,max(q.quote_id) as qid FROM quote q LEFT JOIN leads l ON l.lead_id = q.lead_id LEFT JOIN proforma_invoice pi ON pi.quote_id = q.quote_id WHERE q.lead_id = l.lead_id AND pi.quote_id = q.quote_id AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$q2fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$q2tdate."', '%Y-%m-%d') $quid_query AND q.status=0 GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

    if(count($q2quotelist)>0)
    {
      foreach($q2quotelist as $q2list)
      {
        $quote2prodindus = $this->db->query("SELECT qp.*, i.industry_name FROM `quote_product` qp,product_items pi,products p, industries i WHERE qp.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND p.industry_id = i.industry_id AND qp.quote_id = '".$q2list['qid']."' AND p.product_id = '".$qlist->product_id."' ")->result_array();
        $q2c+=count($quote2prodindus);
      }
    }

    $q3quotelist = $this->db->query("SELECT q.*,max(q.quote_id) as qid FROM quote q LEFT JOIN leads l ON l.lead_id = q.lead_id LEFT JOIN proforma_invoice pi ON pi.quote_id = q.quote_id WHERE q.lead_id = l.lead_id AND pi.quote_id = q.quote_id AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$q3fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$q3tdate."', '%Y-%m-%d') $quid_query AND q.status=0 GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

    if(count($q3quotelist)>0)
    {
      foreach($q3quotelist as $q3list)
      {
        $quote3prodindus = $this->db->query("SELECT qp.*, i.industry_name FROM `quote_product` qp,product_items pi,products p, industries i WHERE qp.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND p.industry_id = i.industry_id AND qp.quote_id = '".$q3list['qid']."' AND p.product_id = '".$qlist->product_id."' ")->result_array();
        $q3c+=count($quote3prodindus);
      }
    }

    $q4quotelist = $this->db->query("SELECT q.*,max(q.quote_id) as qid FROM quote q LEFT JOIN leads l ON l.lead_id = q.lead_id LEFT JOIN proforma_invoice pi ON pi.quote_id = q.quote_id WHERE q.lead_id = l.lead_id AND pi.quote_id = q.quote_id AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$q4fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$q4tdate."', '%Y-%m-%d') $quid_query AND q.status=0 GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

    if(count($q4quotelist)>0)
    {
      foreach($q4quotelist as $q4list)
      {
        $quote4prodindus = $this->db->query("SELECT qp.*, i.industry_name FROM `quote_product` qp,product_items pi,products p, industries i WHERE qp.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND p.industry_id = i.industry_id AND qp.quote_id = '".$q4list['qid']."' AND p.product_id = '".$qlist->product_id."' ")->result_array();
        $q4c+=count($quote4prodindus);
      }
    }

    $tcount=$q1c+$q2c+$q3c+$q4c;

    ?>
    <tr>
      <td><h5><?php echo $qlist->product_name;?></h5></td>
      <td align="center"><h4 class="text-danger"><?php $tot_tar_count = get_target_count_based_on_industry($qlist->product_id,$fy);  $whole_tar_tot_count = $whole_tar_tot_count + $tot_tar_count->total_industry_target_count; echo $tot_tar_count->total_industry_target_count; ?></td>
      <td align="center"><h5><?php echo ($q1c == 0) ? '-' : $q1c; ?></h5></td>
      <td align="center"><h5><?php echo ($q2c == 0) ? '-' : $q2c; ?></h5></td>
      <td align="center"><h5><?php echo ($q3c == 0) ? '-' : $q3c; ?></h5></td>
      <td align="center"><h5><?php echo ($q4c == 0) ? '-' : $q4c; ?></h5></td>
      <td style="background: #f2ee87;" align="center"><h4 class="text-green"><?php echo ($tcount == 0) ? '-' : $tcount; ?></h4></td>
      <td align="center"><h5><?php $balance = $tot_tar_count->total_industry_target_count - $tcount; echo ($balance == 0) ? '-' : $balance; ?></h5></td>
    </tr>
  <?php $q1cc+=$q1c;$q2cc+=$q2c;$q3cc+=$q3c;$q4cc+=$q4c;$tcountc+=$tcount;$balancec+=$balance; } ?>
 </tbody>
 <tfoot>
    <tr>
      <td align="center"><h5>Total</h5></td>
      <td style="background: #f2ee87;" align="center"><h4 class="text-green"><?php echo ($whole_tar_tot_count == 0) ? '-' : $whole_tar_tot_count; ?></h4></td>
      <td style="background: #f2ee87;" align="center"><h4 class="text-green"><?php echo ($q1cc == 0) ? '-' : $q1cc; ?></h4></td>
      <td style="background: #f2ee87;" align="center"><h4 class="text-green"><?php echo ($q2cc == 0) ? '-' : $q2cc; ?></h4></td>
      <td style="background: #f2ee87;" align="center"><h4 class="text-green"><?php echo ($q3cc == 0) ? '-' : $q3cc; ?></h4></td>
      <td style="background: #f2ee87;" align="center"><h4 class="text-green"><?php echo ($q4cc == 0) ? '-' : $q4cc; ?></h4></td>
      <td style="background: #f2ee87;" align="center"><h4 class="text-green"><?php echo ($tcountc == 0) ? '-' : $tcountc; ?></h4></td>
      <td style="background: #f2ee87;" align="center"><h4 class="text-green"><?php echo ($balancec == 0) ? '-' : $balancec; ?></h4></td>
    </tr>
 </tfoot>
</table> 
<table id="target_report_export" style="display: none;">
 <thead>
    <tr>
       <th>Product</th>
       <th>Target</th>
       <th>Q1</th>
       <th>Q2</th>
       <th>Q3</th>
       <th>Q4</th>
       <th>Achieved</th>
       <th>Balance</th>
       
    </tr>
 </thead>
 <tbody>
  <?php $i=0; $date_format =common_date_format();$balance=$whole_tar_tot_count=$q1cc=$q2cc=$q3cc=$q4cc=$balancec=$tcountc=0;foreach ($user_products_list as $qlist){
    $yr = explode('-', $fy);

    $q1fdate = $yr[0].'-04-01';
    $q1tdate = $yr[0].'-06-30';

    $q2fdate = $yr[0].'-07-01';
    $q2tdate = $yr[0].'-09-30';

    $q3fdate = $yr[0].'-10-01';
    $q3tdate = $yr[0].'-12-31';

    $q4fdate = $yr[1].'-01-01';
    $q4tdate = $yr[1].'-03-31';

    $q1c=$q2c=$q3c=$q4c=$tcount=0;
    if ($quid != '') {
      $quid_query = "AND l.lead_assigned_to = '$quid'";
    }
    else {
      $quid_query = ""; 
    }
    $q1quotelist = $this->db->query("SELECT q.*,max(q.quote_id) as qid FROM quote q LEFT JOIN leads l ON l.lead_id = q.lead_id LEFT JOIN proforma_invoice pi ON pi.quote_id = q.quote_id WHERE q.lead_id = l.lead_id AND q.quote_id = pi.quote_id AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$q1fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$q1tdate."', '%Y-%m-%d') $quid_query AND q.status=0 GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

    if(count($q1quotelist)>0)
    {
      foreach($q1quotelist as $q1list)
      {
        $quote1prodindus = $this->db->query("SELECT qp.*, i.industry_name FROM `quote_product` qp,product_items pi,products p, industries i WHERE qp.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND p.industry_id = i.industry_id AND qp.quote_id = '".$q1list['qid']."' AND p.product_id = '".$qlist->product_id."' ")->result_array();
        $q1c+=count($quote1prodindus);
      }
    }

    $q2quotelist = $this->db->query("SELECT q.*,max(q.quote_id) as qid FROM quote q LEFT JOIN leads l ON l.lead_id = q.lead_id LEFT JOIN proforma_invoice pi ON pi.quote_id = q.quote_id WHERE q.lead_id = l.lead_id AND pi.quote_id = q.quote_id AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$q2fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$q2tdate."', '%Y-%m-%d') $quid_query AND q.status=0 GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

    if(count($q2quotelist)>0)
    {
      foreach($q2quotelist as $q2list)
      {
        $quote2prodindus = $this->db->query("SELECT qp.*, i.industry_name FROM `quote_product` qp,product_items pi,products p, industries i WHERE qp.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND p.industry_id = i.industry_id AND qp.quote_id = '".$q2list['qid']."' AND p.product_id = '".$qlist->product_id."' ")->result_array();
        $q2c+=count($quote2prodindus);
      }
    }

    $q3quotelist = $this->db->query("SELECT q.*,max(q.quote_id) as qid FROM quote q LEFT JOIN leads l ON l.lead_id = q.lead_id LEFT JOIN proforma_invoice pi ON pi.quote_id = q.quote_id WHERE q.lead_id = l.lead_id AND pi.quote_id = q.quote_id AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$q3fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$q3tdate."', '%Y-%m-%d') $quid_query AND q.status=0 GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

    if(count($q3quotelist)>0)
    {
      foreach($q3quotelist as $q3list)
      {
        $quote3prodindus = $this->db->query("SELECT qp.*, i.industry_name FROM `quote_product` qp,product_items pi,products p, industries i WHERE qp.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND p.industry_id = i.industry_id AND qp.quote_id = '".$q3list['qid']."' AND p.product_id = '".$qlist->product_id."' ")->result_array();
        $q3c+=count($quote3prodindus);
      }
    }

    $q4quotelist = $this->db->query("SELECT q.*,max(q.quote_id) as qid FROM quote q LEFT JOIN leads l ON l.lead_id = q.lead_id LEFT JOIN proforma_invoice pi ON pi.quote_id = q.quote_id WHERE q.lead_id = l.lead_id AND pi.quote_id = q.quote_id AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$q4fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$q4tdate."', '%Y-%m-%d') $quid_query AND q.status=0 GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

    if(count($q4quotelist)>0)
    {
      foreach($q4quotelist as $q4list)
      {
        $quote4prodindus = $this->db->query("SELECT qp.*, i.industry_name FROM `quote_product` qp,product_items pi,products p, industries i WHERE qp.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND p.industry_id = i.industry_id AND qp.quote_id = '".$q4list['qid']."' AND p.product_id = '".$qlist->product_id."' ")->result_array();
        $q4c+=count($quote4prodindus);
      }
    }

    $tcount=$q1c+$q2c+$q3c+$q4c;

    ?>
    <tr>
      <td><?php echo $qlist->product_name;?></td>
      <td><?php $tot_tar_count = get_target_count_based_on_industry($qlist->product_id,$fy);  $whole_tar_tot_count = $whole_tar_tot_count + $tot_tar_count->total_industry_target_count; echo $tot_tar_count->total_industry_target_count; ?></td>
      <td><?php echo ($q1c == 0) ? '-' : $q1c; ?></td>
      <td><?php echo ($q2c == 0) ? '-' : $q2c; ?></td>
      <td><?php echo ($q3c == 0) ? '-' : $q3c; ?></td>
      <td><?php echo ($q4c == 0) ? '-' : $q4c; ?></td>
      <td><?php echo ($tcount == 0) ? '-' : $tcount; ?></td>
      <td><?php $balance = $tot_tar_count->total_industry_target_count - $tcount; echo ($balance == 0) ? '-' : $balance; ?></td>
    </tr>
  <?php $q1cc+=$q1c;$q2cc+=$q2c;$q3cc+=$q3c;$q4cc+=$q4c;$tcountc+=$tcount;$balancec+=$balance; } ?>
 </tbody>
 <tfoot>
    <tr>
      <td>Total</td>
      <td><?php echo ($whole_tar_tot_count == 0) ? '-' : $whole_tar_tot_count; ?></td>
      <td><?php echo ($q1cc == 0) ? '-' : $q1cc; ?></td>
      <td><?php echo ($q2cc == 0) ? '-' : $q2cc; ?></td>
      <td><?php echo ($q3cc == 0) ? '-' : $q3cc; ?></td>
      <td><?php echo ($q4cc == 0) ? '-' : $q4cc; ?></td>
      <td><?php echo ($tcountc == 0) ? '-' : $tcountc; ?></td>
      <td align="center"><?php echo ($balancec == 0) ? '-' : $balancec; ?></td>
    </tr>
 </tfoot>
</table>          
<script type="text/javascript">
   var DatatablesBasicScrollable = {
    init: function() {
       
        $(".usage_cost4").DataTable({
            scrollY: "50vh",
            scrollX: !0,
            scrollCollapse: !0,paging:0,
                    ordering:false,
            fixedColumns: {
                                 leftColumns: 1,
                                 rightColumns: 1
                             }
         
        })
    }
};
DatatablesBasicScrollable.init().fnDestroy();
  jQuery(document).ready(function() {
       DatatablesBasicScrollable.init()
   });
   </script>