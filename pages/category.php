<?php

include "word_class2.php"; 

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
  
  <a href="homepage2.php">← Back</a>
  
  <?php
  
  $database = $_GET["database"]; 
  $directory = "../database/words/" . str_replace(" ", "_", $database) . ".json"; 
  
  $category_file = file_get_contents($directory);
  $category = json_decode($category_file, true);

  print_category($category); 
  ?>
</body>

</html>

