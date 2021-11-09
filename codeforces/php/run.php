<?php
if($_POST){
  echo shell_exec('~/cpp/cpp < ../input');
 }
else{
echo "404";
}
?>