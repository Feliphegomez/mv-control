<?php
include('_cms/autoload.php');
echo '<table>'
    .'<tr>'.'<td>'.'pageDataGlobal = DataPage'.'</td>'
        .'<td>'.json_encode($pageDataGlobal).'</td>'
    .'</tr>'
.'</table>'
.'<hr>';

$file = "_cms/modules/{$pageDataGlobal->module}/pages/{$pageDataGlobal->page}.php";

if(file_exists($file)){
    include($file);
}else{
    echo 'Archivo no encontrado: '.$file;
}