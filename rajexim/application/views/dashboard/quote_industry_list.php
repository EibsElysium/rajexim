<table class="table table-striped table-bordered m_table_1">
                                         <thead>
                                            <tr>
                                               <th>Industry</th>
                                               <th>Q1</th>
                                               <th>Q2</th>
                                               <th>Q3</th>
                                               <th>Q4</th>
                                               <th>Total</th>
                                            </tr>
                                         </thead>
                                         <tbody>
                                          <?php $i=0; $date_format =common_date_format();$q1cc=$q2cc=$q3cc=$q4cc=$tcountc=0;foreach ($user_industry_list as $qlist){
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

                                            $q1quotelist = $this->db->query("SELECT q.*,max(q.quote_id) as qid FROM `quote` q, leads l WHERE q.lead_id = l.lead_id AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$q1fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$q1tdate."', '%Y-%m-%d') AND l.lead_assigned_to = '".$quid."' AND q.status=0 GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

                                            if(count($q1quotelist)>0)
                                            {
                                              foreach($q1quotelist as $q1list)
                                              {
                                                $quote1prodindus = $this->db->query("SELECT qp.*, i.industry_name FROM `quote_product` qp,product_items pi,products p, industries i WHERE qp.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND p.industry_id = i.industry_id AND qp.quote_id = '".$q1list['qid']."' AND i.industry_id = '".$qlist['industry_id']."' ")->result_array();
                                                $q1c+=count($quote1prodindus);
                                              }
                                            }

                                            $q2quotelist = $this->db->query("SELECT q.*,max(q.quote_id) as qid FROM `quote` q, leads l WHERE q.lead_id = l.lead_id AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$q2fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$q2tdate."', '%Y-%m-%d') AND l.lead_assigned_to = '".$quid."' AND q.status=0 GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

                                            if(count($q2quotelist)>0)
                                            {
                                              foreach($q2quotelist as $q2list)
                                              {
                                                $quote2prodindus = $this->db->query("SELECT qp.*, i.industry_name FROM `quote_product` qp,product_items pi,products p, industries i WHERE qp.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND p.industry_id = i.industry_id AND qp.quote_id = '".$q2list['qid']."' AND i.industry_id = '".$qlist['industry_id']."' ")->result_array();
                                                $q2c+=count($quote2prodindus);
                                              }
                                            }

                                            $q3quotelist = $this->db->query("SELECT q.*,max(q.quote_id) as qid FROM `quote` q, leads l WHERE q.lead_id = l.lead_id AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$q3fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$q3tdate."', '%Y-%m-%d') AND l.lead_assigned_to = '".$quid."' AND q.status=0 GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

                                            if(count($q3quotelist)>0)
                                            {
                                              foreach($q3quotelist as $q3list)
                                              {
                                                $quote3prodindus = $this->db->query("SELECT qp.*, i.industry_name FROM `quote_product` qp,product_items pi,products p, industries i WHERE qp.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND p.industry_id = i.industry_id AND qp.quote_id = '".$q3list['qid']."' AND i.industry_id = '".$qlist['industry_id']."' ")->result_array();
                                                $q3c+=count($quote3prodindus);
                                              }
                                            }

                                            $q4quotelist = $this->db->query("SELECT q.*,max(q.quote_id) as qid FROM `quote` q, leads l WHERE q.lead_id = l.lead_id AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$q4fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$q4tdate."', '%Y-%m-%d') AND l.lead_assigned_to = '".$quid."' AND q.status=0 GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

                                            if(count($q4quotelist)>0)
                                            {
                                              foreach($q4quotelist as $q4list)
                                              {
                                                $quote4prodindus = $this->db->query("SELECT qp.*, i.industry_name FROM `quote_product` qp,product_items pi,products p, industries i WHERE qp.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND p.industry_id = i.industry_id AND qp.quote_id = '".$q4list['qid']."' AND i.industry_id = '".$qlist['industry_id']."' ")->result_array();
                                                $q4c+=count($quote4prodindus);
                                              }
                                            }

                                            $tcount=$q1c+$q2c+$q3c+$q4c;

                                            ?>
                                            <tr>
                                              <td><h5><?php echo $qlist['industry_name'];?></h5></td>
                                              <td align="center"><h5><?php echo $q1c;?></h5></td>
                                              <td align="center"><h5><?php echo $q2c;?></h5></td>
                                              <td align="center"><h5><?php echo $q3c;?></h5></td>
                                              <td align="center"><h5><?php echo $q4c;?></h5></td>
                                              <td align="center"><h4  class="text-green"><?php echo $tcount;?></h4></td>
                                            </tr>
                                          <?php $q1cc+=$q1c;$q2cc+=$q2c;$q3cc+=$q3c;$q4cc+=$q4c;$tcountc+=$tcount;}?>
                                         </tbody>
                                         <tfoot>
                                            <tr>
                                              <td><h5>Total</h5></td>
                                              <td align="center"><h4 class="text-green"><?php echo $q1cc;?></h4></td>
                                              <td align="center"><h4 class="text-green"><?php echo $q2cc;?></h4></td>
                                              <td align="center"><h4 class="text-green"><?php echo $q3cc;?></h4></td>
                                              <td align="center"><h4 class="text-green"><?php echo $q4cc;?></h4></td>
                                              <td align="center"><h4 class="text-green"><?php echo $tcountc;?></h4></td>
                                            </tr>
                                         </tfoot>
                                      </table>