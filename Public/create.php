<?php 
require_once("./Templates/header.php"); 
require_once(__DIR__."/../Controllers/MenuController.php");
use Controllers\MenuController;

$types = array("Menu","Submenu");
if(!isset($_GET["type"]) || !in_array($_GET["type"],$types)) header("Location: ./index.php");
if($_GET["type"] == "Submenu") {
  $menu = new MenuController();
  $rows = $menu->read();
  $select = "<div><select name='selectMenu' id='selectMenu' class='form-select my-2'>";
  foreach($rows as $row){
    $select .= "<option value='".$row["id"]."'>".$row["name"]."</option>";
  }
  $select .= "</select></div>";
}
$select = $select ?? "";
echo <<<MAIN
<main class="container-fluid">
  <div class="container py-2">
    <h2 class="text-info text-center">Create new register</h2>
    <form action="./store.php" method="post" class="shadow-sm p-2">
      <div>
        <input type="text" id="name" name="name" placeholder="Enter the name" class="form-control my-2" >
      </div>
      <div>
        <textarea id="description" name="description" placeholder="Enter the description" class="form-control my-2"></textarea>
      </div>
      $select
      <div class="d-flex justify-content-end">
        <button class="btn btn-success">Submit</button>
      </div>
    </form>
  </div>
</main>
MAIN;

require_once("./Templates/footer.php");
