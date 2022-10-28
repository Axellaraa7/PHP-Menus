<?php 
require_once("./Templates/header.php"); 
require_once(__DIR__."/../Controllers/MenuController.php");
require_once(__DIR__."/../Controllers/SubmenuController.php");

$types = array("Menu","Submenu");
if(!isset($_GET["type"]) || !in_array($_GET["type"],$types)) header("Location: ./index.php");

$controller = "\Controllers\\".$_GET["type"]."Controller";
$obj = new $controller;
$obj->readById(array($_GET["id"]));

if($_GET["type"] == "Submenu") {
  $menu = new \Controllers\MenuController();
  $rows = $menu->read();
  $select = "<div><select name='selectMenu' id='selectMenu' class='form-select my-2'>";
  foreach($rows as $row){
    $selected = ($row["id"] == $obj->getIdMenu()) ? "selected='true'" : "";
    echo $selected."<br>"; 
    $select .= "<option value='".$row["id"]."'".$selected.">".$row["name"]."</option>";
  }
  $select .= "</select></div>";
}

$select = $select ?? "";
$name = $obj->getName();
$description = $obj->getDescription();
$id = $obj->getId();

echo <<<MAIN
<main class="container-fluid">
  <div class="container py-2">
    <h2 class="text-info text-center">Menu Form</h2>
    <form action="./update.php" method="post" class="shadow-sm p-2" name="formEdit">
      <div>
        <input type="text" id="name" name="name" placeholder="Enter the name" value="$name" class="form-control my-2" >
      </div>
      <div>
        <textarea id="description" name="description" placeholder="Enter the description" class="form-control my-2">$description</textarea>
      </div>
      $select
      <input type="hidden" name="id" value="$id">
      <div class="d-flex justify-content-end">
        <button class="btn btn-success">Submit</button>
      </div>
    </form>
  </div>
</main>
MAIN;

require_once("./Templates/footer.php");
