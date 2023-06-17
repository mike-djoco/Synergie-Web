<?php

function _dbConnect(){
    $db = mysqli_connect("dwarves.iut-fbleau.fr","djoco", "djoco", "djoco");
    return $db;
}
   
?>