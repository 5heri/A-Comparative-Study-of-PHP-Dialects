<?php
  

  echo ini_get("memory_limit")."\n";
  ini_set("memory_limit","64M");
  echo ini_get("memory_limit")."\n";

?>
