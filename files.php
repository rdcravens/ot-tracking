<?php

$files = scandir('./directory/to/list');
sort($files); // this does the sorting
foreach($files as $file){
   echo'<a href="/directory/to/list/'.$file.'">'.$file.'</a>';
}

?>
