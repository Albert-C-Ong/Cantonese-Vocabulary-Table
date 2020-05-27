<?php

/* homepage.php
 *
 * Written by Albert Ong
 */ 

include "word_class.php"; 


function count_categories($categories) {
  
  $count = 0; 
  
  foreach ($categories as $category) {
    
    $subcategories = $category["subcategories"]; 
    
    if ($subcategories) {
      $count += count_categories($subcategories);  
    }
    else {
      $count += 1;
      
    }
  }
  
  return $count; 
}


function print_categories($categories) {
  
  echo "<ul>"; 

  foreach ($categories as $category) {
    
    $name = $category["name"]; 
    $chinese = $category["chinese"];
    $subcategories = $category["subcategories"]; 
    
    echo "<li>$name ($chinese)</li>"; 
    
    if ($subcategories) {
      print_categories($subcategories); 
    }
  }

  echo "</ul>"; 
}

//function countCategories($categories) {
//  
//  $count = 0;
//  
//  foreach ($categories -> children() as $category) {
//    
//    $tag_name = $category -> getName();
//    
//    if ($tag_name == "subcategories") {
//      $count += countCategories($category);
//    }
//    else {
//      $count += 1;
//    }
//  }
//  
//  return $count; 
//}


//function printCategories($categories, 
//                         $head = true, 
//                         $subhead = false, 
//                         $dividing_indices = array(), 
//                         $count = 0, 
//                         $parent = "") {
//  
//  global $link_to_header; 
//  
//  if ($head) {
//    
//    echo "<td><ul>"; 
//    
//    $total_category_count = countCategories($categories); 
//  
//    for ($i = 1; $i < 4; $i++) {
//
//      $index = ceil($division + ($i * ($total_category_count / 4))); 
//
//      array_push($dividing_indices, $index); 
//    }
//  }
//  
//  
//  foreach ($categories -> children() as $category) {
//    
//    $tag_name = $category -> getName(); 
//     
//    if ($tag_name == "subcategories") {
//      
//       $next_subhead = true; 
//      
//       if ($subhead == true) {
//         $next_subhead = false;
//       }
//      
//       $subcat_parent = $category["parent"]; 
//      
//       if ($parent == "") {
//         $next_parent = "$subcat_parent";
//       }
//      else {
//        $next_parent = "$parent-$subcat_parent";;
//      }
//      
//       $count = printCategories($category, false, $next_subhead, $dividing_indices, $count, $next_parent);   
//    }
//    
//    else {
//      $name = $category -> name;
//      $name_lower = strtolower($name); 
//      
//      $chinese = $category -> chinese; 
//
//      $incomplete = $category["incomplete"]; 
//
//      $incomplete_text = ""; 
//      
//      if ($incomplete != '') {
//        $incomplete_text = "(incomplete)";
//      }
//      
//      
//      if ($parent == "") {
//        $category_link = strtolower($name);
//      }
//      else {
//        $category_link = strtolower("$parent-$name");
//      }
//      
//      $category_link = str_replace(" ", "-", $category_link);
//
//      $link_to_header[$category_link] = "$name ($chinese)"; 
//      
//      if (!$head && !$subhead) {
//        echo "<ul><ul><li><a href='#$category_link'>$name ($chinese) $incomplete_text</a></li></ul></ul>\n"; 
//      }
//      
//      else if (!$head) {
//        echo "<ul><li><a href='#$category_link'>$name ($chinese) $incomplete_text</a></li></ul>\n"; 
//      }
//      
//      else {
//        echo "<li><a href='#$category_link'>$name ($chinese) $incomplete_text</a></li>\n"; 
//      }
//      
//      $count += 1; 
//      
//      if (in_array($count, $dividing_indices)) {
//        echo "</ul></td>\n<td><ul>"; 
//      } 
//    }
//  }
//  
//  if ($count == countCategories($categories)) {
//    echo "</ul></td>"; 
//  }
//  
//  
//  return $count; 
//}
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
        
    </tr>
  </table>
  
  <?php
  $categories_file = file_get_contents("../database/categories.json");
  $categories = json_decode($categories_file, true)["categories"];


  print_categories($categories); 
  ?>
</body>

</html>

