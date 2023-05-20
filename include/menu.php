<?php
$db = db();
$userData = array();
$userData = $_SESSION['userDataHwms'];
$path = $GLOBALS['_path'] . '/resource
/';

$roleId = $userData['roleId'];
$result = mysqli_query($db, "SELECT resource FROM user_role WHERE id = $roleId");
$row = mysqli_fetch_assoc($result);
$resource = explode('-', $row['resource']);
?>


<ul class="side-nav">

  <li class="side-nav-title side-nav-item">Navigation</li>

  <?php

  foreach ($resource as $r) {

    if ($r != '' && $r != " ") {
      $sql = "SELECT * from resource_master where id = " . $r;
      $resultItem = mysqli_query($db, $sql);
      while ($rowItem = mysqli_fetch_assoc($resultItem)) {

        echo "<li class='side-nav-item'>
      <a href='$path$rowItem[link]' class='side-nav-link'>
        <i class='uil-home-alt'></i>
        <span> $rowItem[name] </span>
      </a>
    </li>";
      }
    }
  }



  ?>
</ul>