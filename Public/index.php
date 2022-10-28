<?php
require_once(__DIR__."/Templates/header.php");
require_once(__DIR__."/../Controllers/MenuController.php");
require_once(__DIR__."/../Controllers/SubmenuController.php");

function fn_getRow($data){
  global $menu,$submenu;
  if($data == "all") return array_merge($menu->read(), $submenu->read());
  if($data == "menus") return $menu->read();
  if($data == "submenus") return $submenu->read();
  return array();
}

$menu = new \Controllers\MenuController();
$submenu = new \Controllers\SubmenuController();

if (isset($_POST["option"])) {
  $_GET = array();
  $rows = fn_getRow($_POST["option"]);
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
    <?php if(isset($rows)){ 
      echo <<<TAB
      <div class="table-responsive">
      <table class="table table-striped my-2 align-middle" style="min-width: 700px;">
        <thead class="table-dark text-center">
          <th>#</th>
          <th>Name</th>
          <th>Description</th>
      TAB;
      if($_POST["option"] != "menus") echo "<th>Menu Padre</th>";
      echo <<<TAB1
        <th>Options</th>
        </thead>
        <tbody class="text-center">
      TAB1;
      foreach($rows as $index=>$row){
        $idMenus = (isset($row["id_menus"])) 
        ? "<td>".$row["id_menus"]."</td>" : (($_POST["option"] == "all") ? "<td></td>" : "");
        $type = (isset($row["id_menus"])) ? "Submenu" : "Menu";
        $id = $row["id"];
        $name = $row["name"];
        $description = $row["description"];
        $i = $index+1;
          echo <<<TAB2
          <tr><td>$i</td>
          <td>$name</td>
          <td>$description</td>$idMenus
          <td><a href='./edit.php?type=$type&id=$id' class='btn btn-warning'>EDIT &#128393;</a>
          <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modal' data-bs-whatever='type=$type&id=$id'>
          DELETE &#128465;</button></td></tr>
          TAB2;
      }
      echo "</tbody></table></div>";
    } ?>
  </div>
</main>

<?php 
include_once(__DIR__."/components/modal.php");
require_once(__DIR__."/Templates/footer.php");
?>