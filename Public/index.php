<?php
require_once(__DIR__ . "/Templates/header.php");
require_once "./autoload.php";
// require_once("/9TESTS/1.S2Next/Controllers/MenuController.php");
// require_once("/9TESTS/1.S2Next/Controllers/SubmenuController.php");

use Controllers\MenuController;
use Controllers\SubmenuController;

$menu = new MenuController();
$submenu = new SubmenuController();

if (isset($_POST["option"])) {
  $_GET = array();
  $col = "";
  if ($_POST["option"] == "all") { $rows = array_merge($menu->read(),  $submenu->read()); $col = "<td></td>"; }
  else if ($_POST["option"] == "menus") $rows = $menu->read();
  else if ($_POST["option"] == "submenus") $rows = $submenu->read(); 
  else $rows = array();
}
?>

<main class="container-fluid">
  <div class="container my-2 py-2">
    <?php 
    if(isset($_GET["success"])){
      $alert = ($_GET["success"]) ? "Se realizó de manera correcta la operación" : "No se realizó de manera correcta";
      $style = ($_GET["success"]) ? "alert-success" : "alert-danger";
      echo "<div class='alert $style' role='alert'> $alert  </div>";
    }?>
    <form action="" method="post" class="my-2">
      <div class="row">
        <label for="options" class="col-form-label  col-4">Choose an option</label>
        <div class="col-8">
          <select name="option" id="options" class="form-select">
            <option value="...">...</option>
            <option value="all">All</option>
            <option value="menus">Menus</option>
            <option value="submenus">Submenus</option>
          </select>
        </div>
      </div>
    </form>
    <?php if(isset($rows)){ ?>
    <div class="table-responsive">
      <table class="table table-striped my-2 align-middle" style="min-width: 700px;">
        <thead class="table-dark text-center">
          <th>#</th>
          <th>Name</th>
          <th>Description</th>
          <?php if($_POST["option"] != "menus") echo "<th>Menu Padre</th>"; ?>
          <th>Options</th>
        </thead>
        <tbody class="text-center">
        <?php
        foreach($rows as $index=>$row){
          $idMenus = (isset($row["id_menus"])) ? "<td>".$row["id_menus"]."</td>" : $col;
          $type = (isset($row["id_menus"])) ? "Submenu" : "Menu";
          echo "<tr><td>".($index+1)."</td>
          <td>".$row["name"]."</td>
          <td>".$row["description"]."</td>".$idMenus."
          <td><a href='./edit.php?type=".$type."&id=".$row["id"]."' class='btn btn-warning'>
          EDIT &#128393;</a>
          <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modal' data-bs-whatever='type=".$type."&id=".$row["id"]."'>
          DELETE &#128465;</button></td></tr>";
        }
        ?>
        </tbody>
      </table>
    </div>
    <?php } ?>
  </div>
</main>

<?php 
include_once(__DIR__."/components/modal.php");
require_once(__DIR__."/Templates/footer.php");
?>