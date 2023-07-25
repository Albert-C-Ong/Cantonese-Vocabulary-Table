<?php

/* homepage.php
 *
 * Written by Albert Ong
 */ 


function print_categories($categories, $count = 1, $tab = 0) {
  
  $db = new SQLite3('../database/database.db');
  
  $res = $db -> query("SELECT COUNT(*) FROM categories");
  $total_categories= $res -> fetchArray()[0];
  
  $is_head = $count == 1; 
  
  if ($is_head) {
    echo "<td>";
  }

  echo "<ul>";
  
  
  while ($row = $categories -> fetchArray()) {
    
    $name = $row["name"];
    $chinese = $row["chinese"];
    $parent = $row["parent"];
    $parent2 = $row["parent2"];
    $incomplete = $row["incomplete"];
    
    $dividing_indices = array();  
    $columns = 4;
    
    for ($i = 1; $i < $columns; $i++) {
      $dividing_index = (floor($total_categories / $columns) * $i) + 1; 
      array_push($dividing_indices, $dividing_index);
    }
    
    if (in_array($count, $dividing_indices)) {
        $head = str_repeat("</ul>\n", $tab + 1);
        $tail = str_repeat("<ul>\n", $tab + 1);
        echo "$head</td>\n<td>$tail"; 
    } 

    $incomplete_tag = ($incomplete ? "(incomplete)" : ""); 
    
    $category_vars = "name=$name&parent=$parent&parent2=$parent2&chinese=$chinese";
    
    echo "<li><a href='category.php?$category_vars'>$name ($chinese) $incomplete_tag</a></li>\n"; 

    $res = $db -> query("SELECT COUNT(*) FROM categories WHERE parent is '$name'");
    $has_subcategories = $res -> fetchArray()[0] != 0;

    if ($has_subcategories) {

      $query = "SELECT * FROM categories 
                WHERE parent is '$name' 
                ORDER BY name";

      $subcategories = $db -> query($query); 
      $count = print_categories($subcategories, $count + 1, $tab + 1); 
    }
    else {
      $count += 1;
    }
  }
  
  echo "</ul>\n";

  $is_tail = $count == $total_categories;
  
  if ($is_tail) {
    echo "</td>";
  }
  
  return $count; 
}
?>

<html>

<head>
<title>Cantonese Vocabulary Table | 廣東話詞彙圖表</title> 

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="icon" type="image/png" href="../assets/favicon.png">
<style>
h1, h2, h3 {
  color: black;
  text-align: center;
}

.table-heading {
  background-color: lightgray;
}
.text-black {
  color: black;
}

ul {
  margin-left: -15px;
}

ul ul {
  margin-left: -20px;
}
</style>

</head>

<body>
<div class="mx-5 mt-4">
  <a href="search.php">← Search</a>
</div>

<h1 class="mt-2">Cantonese Vocabulary Table<br>廣東話詞彙圖表</h1>

<div class="container w-100">
  <table class="table table-bordered border-dark text-black mt-5">
    <tr class="table-heading">
      <td colspan="4"><h3>Table of Contents (目錄)</h3></td>
    </tr>
    <tr>
      <?php
      $db = new SQLite3('../database/database.db');
      
      $categories = $db -> query("SELECT * FROM categories WHERE parent IS NULL");
      print_categories($categories); 
      ?>    
    </tr>
  </table>
</div>
</body>

</html>

