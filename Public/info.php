<?php
require_once(__DIR__."/Templates/header.php");
require_once(__DIR__."/../Controllers/MenuController.php");
require_once(__DIR__."/../Controllers/SubmenuController.php");
// echo realpath(__DIR__);
$objMenu = new \Controllers\MenuController();
$objSubMenu = new \Controllers\SubmenuController();
$menus = $objMenu->read();
if(isset($_GET["type"])){
  switch(ucfirst($_GET["type"])){
    case "Menu":
      $objMenu->readById(array($_GET["id"]));
      break;
    case "Submenu":
      $objSubMenu->readById(array($_GET["id"]));
      break;
    default:
      break;
  }
} 
?>

<main class="container-fluid my-2">
  <nav class="navbar navbar-expand-sm bg-dark">
    <div class="container-fluid">
      <div class="collapse navbar-collapse justify-content-sm-end gap-2 my-2" id="navbarMenus">
        <?php
          foreach($menus as $menu){
            $submenus = $objMenu->makeRelation(array($menu["id"]));
            $dropdown = "
            <div class='nav-item dropdown'>
              <a class='btn btn-light dropdown-toggle' href='./info.php?type=Menu&id=".$menu["id"]."' data-bs-toggle='dropdown' aria-expanded=false'>".$menu["name"]."</a>
              <ul class='dropdown-menu'>";
            foreach($submenus as $submenu){
              $dropdown .= "<li><a class='dropdown-item' href='./info.php?type=Submenu&id=".$submenu["id"]."'>".$submenu["name"]."</a></li>";
            }
            echo $dropdown."</ul></div>";
          }
        ?>
      </div>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarMenus" aria-controls="navbarMenus" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span> 
      </button>
    </div>
  </nav>
  <?php if(!($objSubMenu->getName() === null)){
    echo "
    <div class='container my-2'>
    <div class='card' style='width: 18rem;'>
      <div class='card-body'>
      <h5 class='card-title'>Title: ".$objSubMenu->getName()."</h5>
      <p class='card-text'>Description: ".$objSubMenu->getDescription()."</p>
      </div></div></div>";
  }
  ?>
</main>