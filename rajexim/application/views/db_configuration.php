<?php
  $err = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Database Configuration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" style="width: 322px;">
  <h2>Database Information</h2>
  <form action="<?php echo base_url(); ?>Login/db_dyno_config" method="POST">
    <div class="form-group">
      <label for="email">Host:<span class="text-danger">*</span></label>
      <input type="text" class="form-control" required id="host" placeholder="Enter " name="host">
    </div>
    <div class="form-group">
      <label for="pwd">Username:<span class="text-danger">*</span></label>
      <input type="text" class="form-control" required id="username" placeholder="Enter " name="username">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="text" class="form-control" id="pass" placeholder="Enter " name="pass">
    </div>
    <div class="form-group">
      <label for="pwd">Database:<span class="text-danger">*</span></label>
      <input type="text" class="form-control" required id="dbname" placeholder="Enter " name="dbname">
    </div>
    <div class="text-center"><button type="submit" name ="sub" class="btn btn-primary">Submit</button></div>
    
    <p class="text-primary"><?php echo $err; ?></p>
  </form>
</div>

</body>
</html>
