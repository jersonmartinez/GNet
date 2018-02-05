<?php
  @$TestRoot   = $IC->query("SELECT * FROM ".$X."root WHERE username='".$GameResult['usr']."' LIMIT 1")->num_rows;
  @$TestAdmin  = $IC->query("SELECT * FROM ".$X."admin WHERE username='".$GameResult['usr']."' LIMIT 1")->num_rows;
  @$TestStudent= $IC->query("SELECT * FROM ".$X."student WHERE username='".$GameResult['usr']."' LIMIT 1")->num_rows;
  @$TestMaster = $IC->query("SELECT * FROM ".$X."master WHERE username='".$GameResult['usr']."' LIMIT 1")->num_rows;
  @$TestTutor  = $IC->query("SELECT * FROM ".$X."tutor WHERE username='".$GameResult['usr']."' LIMIT 1")->num_rows;

  if ($TestRoot > 0){
    $PSend = "root";
    $Privilege = "Root";
  } if ($TestAdmin > 0) {
    $PSend = "admin";
    $Privilege = "Administrador";
  } if ($TestMaster > 0) {
    $PSend = "master";
    $Privilege = "Maestro";
  } if ($TestStudent > 0) {
    $PSend = "student";
    $Privilege = "Estudiante";
  } if ($TestTutor > 0){
    $PSend = "tutor";
    $Privilege = "Tutor";
  }
?>