<?php
function datosreferer(){
  if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== null){
    $re = $_SERVER['HTTP_REFERER'] ;
    $Z = md5($re);
    $A = substr($Z,0,2); 
    $B = substr($Z,16,1); 
    $C = substr($Z,30,1); 
    $D = substr($Z,23,1); 
    $shortcut = $A.$B.$C.$D;
    $contents= false;
    $refer = "./Data/$shortcut";
    if(file_exists($refer) == true){
      $row = file($refer,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      $referer = $row['0'];
      $count = $row['1'];
      $count++;
      $contents .= $referer."\r\n";
      $contents .= $count;
      file_put_contents($refer,$contents);
    }else{
      $count = 0;
      $contents .= $re."\r\n";
      $contents .= $count;
      file_put_contents($refer,$contents);
    }
    return true;
  }else{
    return false;
  }
}

if (isset($_GET['id'])) {
  @$id = isset($_GET['id']) ? $_GET['id'] : '';
  datosreferer();
}else{
  header('Location:'.$conf['redirect'].'');
}
