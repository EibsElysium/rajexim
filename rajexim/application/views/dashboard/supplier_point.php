<table class="table table-striped table-bordered" id='sctable'>
                                                <thead>
                                                   <tr>
                                                      <th>Name</th>
                                                      <th>Product</th>
                                                      <th>Scores</th>                                            
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                  <?php foreach($topleast_supplier_list as $tlsl)
                                                  {

                                                    $vendor_product_details = $this->Vendor_model->get_vendor_product_by_id($tlsl['vendor_id']);
                                                    $vparr = []; foreach($vendor_product_details as $vprod){
                                                       array_push($vparr, $vprod['product_name']);
                                                    }
                                                    $vprod = implode(', ', $vparr);
                                                    if($tlsl['points']>=0)
                                                    {
                                                      $cclass = 'text-green';
                                                    }
                                                    else
                                                    {
                                                      $cclass = 'text-danger';
                                                    }
                                                    ?>
                                                      <tr>
                                                         <td><h5><?php echo $tlsl['vendor_name']; ?></h5></td>
                                                         <td align="center"><?php echo str_replace(',', ', ', $vprod); ?>  </td>            
                                                         <td align="center"><h4  class="<?php echo $cclass;?>"><?php echo $tlsl['points'];?></h4></td>
                                                      </tr>
                                                  <?php }?>
                                                   
                                                </tbody>
                                                
                                             </table>

<script>
$('#sctable').dataTable({
        /* Disable initial sort */
        "aaSorting": []
    });
</script>                                             
