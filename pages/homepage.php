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
    echo "<td><ul>";
  }
  
  
  while ($row = $categories -> fetchArray()) {
    
    $name = $row["name"];
    $chinese = $row["chinese"];
    $parent = $row["parent"];
    $incomplete = $row["incomplete"];
    
    $dividing_indices = array();  
    $columns = 4;
    
    for ($i = 1; $i < $columns; $i++) {
      $dividing_index = (floor($total_categories / $columns) * $i) + 1; 
      array_push($dividing_indices, $dividing_index);
    }
    
    if (in_array($count, $dividing_indices)) {
        echo "</ul></td>\n<td><ul>"; 
    } 
    
    $head = "        " . str_repeat("<ul>", $tab) . "<li>";
    $tail = "</li>" . str_repeat("</ul>", $tab);
    $incomplete_tag = ($incomplete ? "(incomplete)" : ""); 
  
    echo "$head<a href='category.php?category_name=$name'>$name ($chinese) $incomplete_tag</a>$tail\n"; 

    $res = $db -> query("SELECT COUNT(*) FROM categories WHERE parent is '$name'");
    $has_subcategories = $res -> fetchArray()[0] != 0;

    if ($has_subcategories) {
      $subcategories = $db -> query("SELECT * FROM categories WHERE parent is '$name'"); 
      $count = print_categories($subcategories, $count + 1, $tab + 1); 
    }
    else {
      $count += 1;
    }
  }
  
  $is_tail = $count == $total_categories;
  
  if ($is_tail) {
    echo "</ul></td>";
  }
  
  return $count; 
}
?>


<html>

<head>
  <title>Cantonese Vocabulary Table | 廣東話詞彙圖表</title> 
  
  <link rel="stylesheet" type="text/css" href="../assets/master.css">
  <link rel="icon" type="image/png" href="../assets/favicon.png">
</head>

<body>
  
  <h1>Cantonese Vocabulary Table<br>廣東話詞彙圖表</h1>

  <form method="GET">
    <table class="table-of-contents">
      <tr>
        <td class="heading" colspan="4"><h2>Table of Contents (目錄)</h2></td>
      </tr>
      <tr>
        <?php
        $db = new SQLite3('../database/database.db');
        
        $categories = $db -> query("SELECT * FROM categories WHERE parent IS NULL");
        print_categories($categories); 
        ?>    
      </tr>
    </table>
  </form>
  
</body>

</html>

