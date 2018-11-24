<?php
session_start();
include('_cms/autoload.php');

echo $pageDataGlobal->htmlRun();