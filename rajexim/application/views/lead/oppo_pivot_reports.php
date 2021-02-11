<!DOCTYPE html>
<html lang="en">
<head>
  <title>Opportunity Pivot Report Export</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .alert-info {
        color: #ffffff;
        background-color: #274180;
        border-color: #274180;
    }
  </style>
</head>
<body>
<?php 
  if($left_side == 'cb.country')
  { 
    $top_col_name = 'Country'; 
  }
  else if($left_side == 'l.lead_source_id')  
  {
    $top_col_name = 'Sub Lead Source'; 
  }
  else if($left_side == 'l.product_id')  
  {
    $top_col_name = 'Product'; 
  }
  else if($left_side == 'l.lead_assigned_to')  
  {
    $top_col_name = 'Assigned User'; 
  }
  else if($left_side == 'l.lead_status_id')  
  {
    $top_col_name = 'Lead Status'; 
  }
  else if($left_side == 'l.lead_type_id')  
  {
    $top_col_name = 'Lead Type'; 
  }

  if($top_of_table == 'cb.country')
  { 
    $top_col_table_name = 'Country'; 
  }
  else if($top_of_table == 'l.lead_source_id')  
  {
    $top_col_table_name = 'Sub Lead Source'; 
  }
  else if($top_of_table == 'l.product_id')  
  {
    $top_col_table_name = 'Product'; 
  }
  else if($top_of_table == 'l.lead_assigned_to')  
  {
    $top_col_table_name = 'Assigned User'; 
  }
  else if($top_of_table == 'l.lead_status_id')  
  {
    $top_col_table_name = 'Lead Status'; 
  }
  else if($top_of_table == 'l.lead_type_id')  
  {
    $top_col_table_name = 'Lead Type'; 
  }
?>
<div class="container">
  <br><br>  
  <div class="alert alert-info"><h4 class="text-center"><?php echo $top_col_name.' And '.$top_col_table_name.' Report'; ?></h2></div>  
  <div class="row">
    <div class="pull-right">
      <button type="button" class="btn btn-primary" onclick="lead_pivot_report_export('pivot_table', 'lead_pivot');">Export As Excel</button>
    </div>
  </div>  
  <br><br>                
  <table class="table table-bordered" id="pivot_table">
    <thead>
      <tr>
        <th><?php echo $top_col_name; ?></th>
        <?php $i=1; foreach($loop_array_top as $top_name){  ?>
        <th><?php echo $top_name['top_column_name']; ?></th>
        <?php ${"row_tot$i"} = ''; $i++; } ?>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php $tot_col_tot = 0; $j=1; foreach($loop_array_left as $left_name){ ${'col_tot$j'} = 0; ?>
      <tr>
        
          <td><?php echo $left_name['left_column_name']; ?></td>
          <?php $i = 1;  foreach($loop_array_top as $top_name){  ?>
          <td><?php $get_count_of_xy = get_oppo_dynamic_pivot_report($left_side, $top_of_table, $left_name['left_column_id'], $top_name['top_column_id'], $lst, $ls, $dtrange, $lst, $p_year, $p_month, $product, $country, $ass_to); echo $get_count_of_xy->lead_count; ${'col_tot$j'} = ${'col_tot$j'} + $get_count_of_xy->lead_count; ${"row_tot$i"} = (int)${"row_tot$i"} + (int)$get_count_of_xy->lead_count; ?></td>
        <?php $i++; } ?>
        <td><?php $tot_col_tot = $tot_col_tot + ${'col_tot$j'}; echo ${'col_tot$j'}; ?></td>
      </tr>
      <?php $j++; } ?>
    </tbody>
    <tfoot>
      <tr>
        <td>Total</td>
        <?php $k=1; foreach($loop_array_top as $top_name){ ?>
        <td><?php echo ${"row_tot$k"}; ?></td>
        <?php $k++; } ?>
        <td><?php echo $tot_col_tot; ?></td>
      </tr>
    </tfoot>
  </table>
</div>
<script>
  function lead_pivot_report_export(tableID, filename = ''){
    var date = new Date();

    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();

    newdate = (year + "-" + month + "-" + day + "-" + hours + "-" + minutes + "-" + seconds);

    var downloadurl;
    var dataFileType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+newdate+'.xls':'export_excel_data.xls';
    
    // Create download link element
    downloadurl = document.createElement("a");
    
    document.body.appendChild(downloadurl);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTMLData], {
            type: dataFileType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
    
        // Setting the file name
        downloadurl.download = filename;
        
        //triggering the function
        downloadurl.click();
    }
  }
</script>
</body>
</html>
