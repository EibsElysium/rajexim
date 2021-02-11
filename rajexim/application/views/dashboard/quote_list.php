<table class="table table-striped table-bordered m_table_1">

                                         <thead class="thead-theme">

                                            <tr>

                                               <th>Quote No</th>

                                               <th>Date</th>

                                               <th>Exporter</th>

                                               <th>Consignee</th>

                                               <th>Country</th>

                                               <th>Assigned To</th>

                                               <th>Action</th>

                                               

                                            </tr>

                                         </thead>

                                         <tbody>

                                          <?php $i=0; $date_format =common_date_format();foreach ($quote_list as $qlist){

                                             $quotlist = $this->Quote_model->get_quote_by_id($qlist['qid']);

                                             $qprod = $this->Quote_model->get_quote_product_by_quote_id($qlist['qid']);

                                             ?>

                                              <tr>

                                                <td><h5 class="text-black" style="margin-bottom: 0px;"><?php echo $qlist['quote_no'];?></h5> <?php if($qlist['qcount']>1){?><span class="m-badge m-badge--info pull-right tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="<?php echo $qlist['qcount']-1; ?> QTN Revised"><?php echo $qlist['qcount']-1; ?></span><?php }?>

                                                </td>

                                                <td align="center"><?php echo date($date_format, strtotime($quotlist->created_date)); ?> / <?php echo date($date_format, strtotime($quotlist->valid_till)); ?></td>

                                                <td align="center"><?php echo $quotlist->exporter_name;?></td>

                                                <td align="center"><h5 class="text-black" style="margin-bottom: 0px;"><?php echo $quotlist->lead_name;?></h5></td>

                                                <td align="center"><?php echo $quotlist->country_name; ?></td>

                                                <td align="center"><?php echo $quotlist->lead_assigned_name;?></td>

                                                <td align="center"><?php if($_SESSION['Quote ManagementView']==1){ ?>

                                                <a href="<?php echo base_url(); ?>quote/quote_view/<?php echo $quotlist->quote_id;?>" target="_blank"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;

                                                <?php }?></td>                                              

                                              </tr>

                                              <?php }?>

                                          

                                         </tbody>

                                         

                                      </table>



<script>

$('.m_table_1').dataTable();

</script>                                      