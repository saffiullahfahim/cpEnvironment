<?php
if($_POST){
  $fh = fopen($_POST['p'] , 'w');
  fwrite($fh, $_POST['data']);
  fclose($fh);
  
  $fh = fopen('../input' , 'w');
  fwrite($fh, $_POST['ipt']);
  fclose($fh);
  
  $output = '';
  $p = proc_open(
  'g++ '. $_POST['p'] .' -o ~/cpp/cpp',
  array(
  1 => array('pipe', 'w'),
  2 => array('pipe', 'w')
  ),
  $io
  );
  
  // Read output sent to stdout
  while (false === feof($io[1])) {
  // this will return always false ... and will loop forever until "fork: retry: no child processes" will show if proc_open is disabled;
  $output .= htmlspecialchars(fgets($io[1]), ENT_COMPAT, 'UTF-8');
  }
  // Read output sent to stderr
  while (false === feof($io[2])) {
  $output .= htmlspecialchars(fgets($io[2]), ENT_COMPAT, 'UTF-8');
  }
  // Close everything off
  fclose($io[1]);
  fclose($io[2]);
  proc_close($p);
  
  if($output==''){
  $statusData = "success";
  }
  else{
  $output .= "\n";
  $statusData = $output;
  }
  
  echo $statusData;
  //echo $output;
 }
else{
echo "404";
}
?>