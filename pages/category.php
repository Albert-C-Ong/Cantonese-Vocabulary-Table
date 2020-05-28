<?php

include "word_class2.php"; 

function print_category($category) {
  
  $name = $category["name"]; 
  $chinese = $category["chinese"]; 
  $words = $category["words"]; 
  
  echo 
  "<h1>$name ($chinese)</h1>
    <table>
    <tr>
      <th>Trad. Chinese <br>正體中文</th>
      <th>Jyutping <br>粵拼</th>
      <th>Pinyin <br>拼音 </th>
      <th>English <br>英文</th>
    </tr>"; 
    
  foreach ($words as $word) {

    $word = new Word($word["chinese"], 
              $word["jyutping"], 
              $word["pinyin"], 
              $word["english"]); 

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
  $category_file = file_get_contents("../database/words/adjectives.json");
  $category = json_decode($category_file, true);

  print_category($category); 
  ?>
</body>

</html>

