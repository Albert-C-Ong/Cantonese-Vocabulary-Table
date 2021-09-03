<?php

/* homepage.php
 *
 * Written by Albert Ong
 */ 

include "word_class.php"; 

//~ function count_categories($categories, $count = 0) {
  
  //~ foreach ($categories as $category) {
    
    //~ $subcategories = $category["subcategories"]; 
    
    //~ if ($subcategories) {
      //~ $count = count_categories($subcategories, $count + 1);  
    //~ }
    //~ else {
      //~ $count += 1;
    //~ }
  //~ }
  
  //~ return $count; 
//~ }


function print_categories($categories, $count = 1) {
  
  $db = new SQLite3('../database/database.db');
  
  $is_head = $count == 1; 
  
  if ($is_head) {
    echo "<td>";
  }
  
  echo "<ul>";
  
  while ($row = $categories -> fetchArray()) {
    
    $name = $row["name"];
    $chinese = $row["chinese"];
    $parent = $row["parent"];
    echo "<li><a href='category.php?category=$name'>$name ($chinese)</a></li>"; 

    $res = $db -> query("SELECT COUNT(*) FROM categories WHERE parent is '$name'");
    $has_subcategories = $res -> fetchArray()[0] != 0;

    if ($has_subcategories) {
      $subcategories = $db -> query("SELECT * FROM categories WHERE parent is '$name'"); 
      $count = print_categories($subcategories, $count + 1); 
    }
    else {
      $count += 1;
    }
  }
  
  echo "</ul>";
  
  
  $res = $db -> query("SELECT COUNT(*) FROM categories");
  $total_categories= $res -> fetchArray()[0];
  
  //~ $dividing_indices = array(); 
  //~ $columns = 4;
  
  //~ for ($i = 1; $i < $columns; $i++) {
    //~ $dividing_index = floor($total_categories / $columns) * $i; 
    //~ array_push($dividing_indices, $dividing_index);
  //~ }
  
  //~ if (in_array($count, $dividing_indices)) {
      //~ echo "</ul></td>\n<td><ul>"; 
  //~ } 
  
  
  $is_tail = $count == $total_categories;
  
  if ($is_tail) {
    echo "</td>";
  }
  
  return $count; 
  
  //~ foreach ($categories as $category) {
  
    //~ $name = $category["name"]; 
    //~ $chinese = $category["chinese"];
    //~ $subcategories = $category["subcategories"]; 
    //~ $incomplete = $category["incomplete"]; 
    
    //~ if ($parent == NULL) {
      //~ $parent_text = "NULL";
    //~ }
    //~ else {
      //~ $parent_text = "'$parent'";
    //~ }
    
    //~ if ($incomplete) {
      //~ $incomplete = 1;
    //~ }
    //~ else {
      //~ $incomplete = 0;
    //~ }
    
    //~ echo "('$name', '$chinese', $parent_text, $incomplete),<br>"; 
    
    //~ if ($subcategories) {
      //~ print_categories($subcategories, $name);
    //~ }
  //~ }
  
  //~ $is_head = $count == 0; 
  
  //~ if ($is_head) {
    //~ echo "<td><ul>";
    
    //~ $total_category_count = count_categories($categories); 
    
    //~ $columns = 4; 
    
    //~ for ($i = 1; $i < $columns; $i++) {
      //~ $index = ceil($division + ($i * ($total_category_count / $columns))); 
      //~ array_push($dividing_indices, $index); 
    //~ }
  //~ }

  //~ foreach ($categories as $category) {
    
    //~ $name = $category["name"]; 
    //~ $chinese = $category["chinese"];
    //~ $subcategories = $category["subcategories"]; 
    //~ $incomplete = $category["incomplete"]; 
    //~ $category_link = strtolower($name);
    
    //~ if ($parent == "") {
      //~ $next_parent = strtolower($name); 
    //~ }
    //~ else {
      //~ $next_parent = "$parent" . "/" . strtolower($name);
    //~ }
      
    //~ $head = "        " . str_repeat("<ul>", $tab) . "<li>";
    //~ $tail = "</li>" . str_repeat("</ul>", $tab);
    //~ $incomplete_tag = ($incomplete ? "(incomplete)" : ""); 
    
    //~ echo "$head<a href='category.php?database=$next_parent'>$name ($chinese) $incomplete_tag</a>$tail\n";
    
    //~ $count += 1; 
    
    //~ if (in_array($count, $dividing_indices)) {
      //~ echo "</ul></td>\n<td><ul>"; 
    //~ } 
    
    
    //~ if ($subcategories) {
      //~ $count = print_categories($subcategories, 
                                //~ $count, 
                                //~ $dividing_indices, 
                                //~ $tab + 1, 
                                //~ $next_parent); 
    //~ }
  //~ }

  
  //~ $total_categories = count_categories($categories);
  //~ $is_tail = $count == $total_categories;
  
  //~ if ($is_tail) {
    //~ echo "</ul></td>";
  //~ }
  
  //~ return $count; 
}
?>


<html>

<head>
  <title>Cantonese Vocabulary Table | 廣東話詞彙圖表</title> 
  <link rel="stylesheet" type="text/css" href="../assets/master.css">
  <link rel="icon" type="image/png" href="../assets/favicon.png">
</head>

<body>
  
  <a href="homepage2.php">← List</a>
  
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

