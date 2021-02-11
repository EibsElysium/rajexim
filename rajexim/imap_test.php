<?php
// echo "running";
// shell_exec("C:/xampp/php/php C:/xampp/htdocs/rajexim/index.php welcome index");
// echo "end";
exec("whereis php",$output);

print_r($output);
echo "<br>";
echo $php_path = $output[0];
echo "<br>";
echo $parent_path_of_app = $_SERVER['DOCUMENT_ROOT'];
echo "<br>";
exec("'".$php_path."' '".$parent_path_of_app."'rajexim_wip/index.php welcome index", $res);
print_r($res);

?>