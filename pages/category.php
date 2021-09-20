<?php

include "word_class.php"; 

function print_category($category) {
  
  $name = $category["name"]; 
  $chinese = $category["chinese"]; 
  $words = $category["words"];
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
  "<h1>$name ($chinese)</h1>
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
}
?>


<html>

<head>
  <title>Cantonese Vocabulary Table | 廣東話詞彙圖表</title> 
  <link rel="stylesheet" type="text/css" href="../assets/master.css">
  <link rel="icon" type="image/png" href="../assets/favicon.png">
</head>

<body>
  
  <a href="homepage.php">← Back</a>
  
  <?php
  
  $db = new SQLite3('../database/database.db');
  
  $category_name = $_GET["category_name"]; 
  
  $res = $db -> query("SELECT * FROM categories WHERE name IS '$category_name'");
  
  $category_data = $res -> fetchArray(); 
  $category_chinese_name = $category_data[1];
  $category_parent = $category_data[2];
  
  $category = $category_name; 
  $subcategory = "NULL"; 
  $subcategory2 = "NULL"; 
  
  if ($category_parent != NULL) {
    
    $category = $category_parent; 
    $subcategory = "'$category_name'";
    
    $res = $db -> query("SELECT parent FROM categories WHERE name IS '$category_parent'");
    $category_parent = $res -> fetchArray()[0];
  }
  
  
  if ($category_parent != NULL) {
    $subcategory2 = "'$category_name'"; 
    $subcategory = "'$category'";
    $category = $category_parent; 
  }
  
  if ($category_name != "Resources") {
    
    echo 
  "<h1>$category_name ($category_chinese_name)</h1>
    <table>
    <tr>
      <th>Trad. Chinese <br>正體中文</th>
      <th>Jyutping <br>粵拼</th>
      <th>Pinyin <br>拼音 </th>
      <th>English <br>英文</th>
    </tr>"; 
    
    $query = "SELECT * FROM vocabulary 
              WHERE category IS '$category' 
              AND subcategory IS $subcategory 
              AND subcategory2 IS $subcategory2
              ORDER BY length(chinese), jyutping";
    
    $res = $db -> query($query);
    
    while ($word = $res -> fetchArray()) {
      
      $chinese = $word[0];
      $chinese_variation = $word[1] != null ? "<br>" . $word[1] : null; 
      $jyutping = $word[2];
      $pinyin = $word[3];
      $english = $word[4]; 

      echo "<tr> 
              <td>$chinese$chinese_variation</td> <td>$jyutping</td> <td>$pinyin</td> <td>$english</td> 
            </tr>";
    }

    echo "</table>";
  }
  
  else {
    echo 
    "<h1>Resources (資源)</h1>
     <ul>
    <li><a target = '_blank' href='http://www.cantonese.sheik.co.uk/'>cantonese.sheik.co.uk</a></li>
    <li><a target = '_blank' href='https://www.mdbg.net/chinese/dictionary'>mdbg.net</a></li>
    <li><a target = '_blank' href='http://mylanguages.org/learn_cantonese.php'>mylanguages.org</a></li>
    <li><a target = '_blank' href='https://cantonese.ca/'>cantonese.ca</a></li>
    <li><a target = '_blank' href='https://www.cantoneseclass101.com/cantonese-dictionary/'>cantoneseclass101.com</a></li>
    </ul>"; 
  }
  ?>
</body>

</html>

