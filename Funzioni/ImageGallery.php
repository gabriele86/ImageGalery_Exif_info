<?php

  
    

    function getFolderList($dir)
    {
        
    
   $folders = array_diff(scandir($dir), array('.','..', '.DS_Store'));
   
   return $folders;
    }
    
    function getPhotos($dir)
    {
        
  $files = array();
  if ($handle = opendir($dir)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != ".." && $file != '.DS_Store') {
            if(is_dir($dir.'/'.$file)) {
                $dir2 = $dir.'/'.$file;
                $files[] = getPhotos($dir2);
            }
            else {
              $files[] = $dir.'/'.$file;
            }
        }
    }
    closedir($handle);
    
    return $files;
  }

  return array_flat($files);
    }
    
 function array_flat($array)
    {
        foreach($array as $a) {
    if(is_array($a)) {
      $tmp = array_merge($tmp, array_flat($a));
    }
    else {
      $tmp[] = $a;
    }
    }
}


?>
