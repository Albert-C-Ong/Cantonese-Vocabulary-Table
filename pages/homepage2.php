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
                          $tab = 0, 
                          $parent = "") {
  
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
    $category_link = str_replace(" ", "_", strtolower($name));
    
    if ($parent == "") {
      $next_parent = strtolower($name); 
    }
    else {
      $next_parent = "$parent" . "/" . strtolower($name);
    }
      
    $head = "        " . str_repeat("<ul>", $tab) . "<li>";
    $tail = "</li>" . str_repeat("</ul>", $tab);
    $incomplete_tag = ($incomplete ? "(incomplete)" : ""); 
    
    echo "$head<a href='#$category_link'>$name ($chinese) $incomplete_tag</a>$tail\n";
    
    $count += 1; 
    
    if (in_array($count, $dividing_indices)) {
      echo "</ul></td>\n<td><ul>"; 
    } 
    
    
    if ($subcategories) {
      $count = print_categories($subcategories, 
                                $count, 
                                $dividing_indices, 
                                $tab + 1, 
                                $next_parent); 
    }
  }

  
  $total_categories = count_categories($categories);
  $is_tail = $count == $total_categories;
  
  if ($is_tail) {
    echo "</ul></td>";
  }
  
  return $count; 
}


function print_words($categories, 
                     $tab = 1, 
                     $directory = "../database/words/") {
  
  foreach ($categories as $category) {
    
    $name = $category["name"]; 
    $formatted_name = str_replace(" ", "_", strtolower($name)); 
    
    $chinese = $category["chinese"];
    $subcategories = $category["subcategories"]; 
    $incomplete = $category["incomplete"]; 
    
    $words_directory = "$directory$formatted_name.json";  
    $words_file = file_get_contents($words_directory);
    $words = json_decode($words_file, true)["words"];
    
    $sorted_words = array();
    
    foreach ($words as $word) {

      $word = new Word($word["chinese"], 
                       $word["chinese_variation"], 
                       $word["jyutping"], 
                       $word["pinyin"], 
                       $word["english"]); 

      array_push($sorted_words, $word); 
    }
  
    usort($sorted_words, "cmp_word"); 
    
    echo 
    "<h$tab id='$formatted_name'>$name ($chinese)</h$tab>
      <table>
      <tr>
        <th>Trad. Chinese <br>正體中文</th>
        <th>Jyutping <br>粵拼</th>
        <th>Pinyin <br>拼音 </th>
        <th>English <br>英文</th>
      </tr>"; 
    
    foreach ($sorted_words as $word) {
      echo $word -> to_table_row(); 
    }
    
    echo "</table>"; 
    
    if ($subcategories) {
      print_words($subcategories, $tab + 1, "$directory$formatted_name/"); 
    }
  }
}
?>


<html>

<head>
  <title>Cantonese Vocabulary Table | 廣東話詞彙圖表</title> 
  <link rel="stylesheet" type="text/css" href="../assets/master.css">
  <link rel="icon" type="image/png" href="../assets/favicon.png">
</head>

<body>
  
  <a href="homepage.php">← Table</a>
  
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
  
  <?php
  print_words($categories); 
  ?>
</body>

</html>

