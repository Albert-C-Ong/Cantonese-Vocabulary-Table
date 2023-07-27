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
      $dividing_index = (floor($total_categories / $columns) * $i) + 2; 
      array_push($dividing_indices, $dividing_index);
    }
    
    if (in_array($count, $dividing_indices)) {
        $head = str_repeat("</ul>\n", $tab + 1);
        $tail = str_repeat("<ul>\n", $tab + 1);
        echo "$head</td>\n<td>$tail"; 
    } 

    $incomplete_tag = ($incomplete ? "<span title='incomplete'>*</span>" : ""); 
    
    $category_vars = "name=$name&parent=$parent&parent2=$parent2&chinese=$chinese";
    
    echo "<li><a href='category.php?$category_vars'>$name ($chinese)$incomplete_tag</a></li>\n"; 

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

a {
  text-decoration: none;
}

.bg-lightgray {
  background-color: lightgray;
}

.text-black {
  color: black;
}

.navbar .navbar-text {
  color: black;
}

.table ul {
  margin-left: -15px;
}

.table ul ul {
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
  <table class="table table-bordered border-dark text-black mt-4 mb-5">
    <tr class="bg-lightgray">
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

<nav class="navbar navbar-expand-lg navbar-light bg-lightgray h-25">
  <div class="container align-bottom">
    <div class="navbar-collapse ">
        <ul>
        Resources
          <li><a target="_blank" href="http://www.cantonese.sheik.co.uk/">cantonese.sheik.co.uk</a></li>
          <li><a target="_blank" href="https://www.mdbg.net/chinese/dictionary">mdbg.net</a></li>
          <li><a target="_blank" href="http://mylanguages.org/learn_cantonese.php">mylanguages.org</a></li>
          <li><a target="_blank" href="https://cantonese.ca/">cantonese.ca</a></li>
        </ul>
      <div class="text-end ms-auto">
        <span title="testing testing 123">Created by Albert Ong</span><br>
        <img src="../assets/github_icon.png" height="18px"><a target="_blank" href="https://github.com/Albert-C-Ong/Cantonese-Vocabulary-Table">GitHub</a>
      </div>
    </div>
  </div>
</nav>
</body>

</html>

