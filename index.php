<?php
/* Written by Albert Ong
 *
 * Revision: 2019.12.11
 */ 

function countCategories($categories) {
  
  $count = 0;
  
  foreach ($categories -> children() as $category) {
    
    $tag_name = $category -> getName();
    
    if ($tag_name == "subcategories") {
      $count += countCategories($category);
    }
    else {
      $count += 1;
    }
  }
  
  return $count; 
}



function printCategories($categories, $head = true, $dividing_indices = array(), $count = 0) {
  
  if ($head) {
    
    echo "<td><ul>"; 
    
    $total_category_count = countCategories($categories); 
  
    for ($i = 1; $i < 4; $i++) {

      $index = ceil($division + ($i * ($total_category_count / 4))); 

      array_push($dividing_indices, $index); 
    }
  }
  
  
  foreach ($categories -> children() as $category) {
    
    $tag_name = $category -> getName(); 
    
    if ($tag_name == "subcategories") {
      
       // echo "<ul>\n"; 
       $count = printCategories($category, false, $dividing_indices, $count);   
       // echo "</ul>\n"; 
    }
    
    else {
      $name = $category -> name;
      $chinese = $category -> chinese; 

      $parent = $category["parent"]; 
      $incomplete = $category["incomplete"]; 

      $incomplete_text = ""; 
      if ($incomplete != '') {
        $incomplete_text = "(incomplete)";
      }

      echo "<li>$name ($chinese) $incomplete_text</li>\n"; 
      
      $count += 1; 
      
      if (in_array($count, $dividing_indices)) {
        echo "</ul></td>\n<td><ul>"; 
      }
      
      
    }
  }
  
  if ($count == countCategories($categories)) {
    echo "</ul></td>"; 
  }
  
  
  return $count; 
}
?>

<html>

<head>
  <title>Cantonese Vocabulary Table</title> 
  <link rel="stylesheet" type="text/css" href="assets/master.css">
</head>

<body>
  <h1>Cantonese Vocabulary Table<br>廣東話詞彙圖表</h1>
  
  <table class="table-of-contents">
    <tr>
      <td class="heading" colspan="4"><h2>Table of Contents (目錄)</h2></td>
    </tr>
    <tr>
        <?php
          $categories_file = simplexml_load_file("database/categories.xml") or die("Error: Cannot create object");

          printCategories($categories_file); 
        ?>
    </tr>
  </table>
</body>

</html>

