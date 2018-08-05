<?php
function handleError($query, $message)
{
     echo "<pre>";
     echo $query;
     echo "<pre>";
     echo $message;
     die;
}

?>