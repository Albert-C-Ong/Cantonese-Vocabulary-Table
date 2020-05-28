<?php

/* homepage.php
 *
 * Written by Albert Ong
 */ 

include "word_class.php"; 


function count_categories($categories, $count = 0) {
  
  foreach ($categories as $category) {
    
    $subcategories = $category["subcategories"]; 
    
    if ($subcategories) {
      $count = count_categories($subcategories, $count + 1);  
    }
    else {
      $count += 1;
    }
  }
  
  return $count; 
}


function print_categories($categories, 
                          $count = 0, 
                          $dividing_indices = array(), 
                          $tab = 0) {
  
  $is_head = $count == 0; 
  
  if ($is_head) {
    echo "<td><ul>";
    
    $total_category_count = count_categories($categories); 
    
    $columns = 4; 
    
    for ($i = 1; $i < $columns; $i++) {
      $index = ceil($division + ($i * ($total_category_count / $columns))); 
      array_push($dividing_indices, $index); 
    }
  }

  foreach ($categories as $category) {
    
    $name = $category["name"]; 
    $chinese = $category["chinese"];
    $subcategories = $category["subcategories"]; 
    $incomplete = $category["incomplete"]; 
    $category_link = strtolower($name);
    
    $head = str_repeat("<ul>", $tab) . "<li>";
    $tail = "</li>" . str_repeat("</ul>", $tab);
    $incomplete_tag = ($incomplete ? "(incomplete)" : ""); 
    
    echo "$head<a href='category.php'>$name ($chinese) $incomplete_tag</a>$tail\n";
    
    $count += 1; 
    
    if (in_array($count, $dividing_indices)) {
      echo "</ul></td>\n<td><ul>"; 
    } 
    
    
    if ($subcategories) {
      $count = print_categories($subcategories, 
                                $count, 
                                $dividing_indices, 
                                $tab + 1); 
    }
  }

  
  $total_categories = count_categories($categories);
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
  
  <table class="table-of-contents">
    <tr>
      <td class="heading" colspan="4"><h2>Table of Contents (目錄)</h2></td>
    </tr>
    <tr>
      <?php
      $categories_file = file_get_contents("../database/categories.json");
      $categories = json_decode($categories_file, true)["categories"];

      print_categories($categories); 
      ?>    
    </tr>
  </table>
  
  
</body>

</html>

