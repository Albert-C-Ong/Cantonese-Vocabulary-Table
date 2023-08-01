<?php
/* category.php
 *
 * Written by Albert Ong
 */ 

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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="icon" type="image/png" href="../assets/favicon.png">

<style>
h1, h2, h3 {
  color: black;
  text-align: center;
}

.table-heading {
  background-color: lightgray;
}
.text-black {
  color: black;
}
</style>
</head>

<body>
  <div class="mx-5 mt-4">
    <a href="homepage.php">← Back</a>
  </div>
  
  <?php
  
  $db = new SQLite3('../database/database.db');
  
  $category_name = $_GET["name"]; 
  $category_parent = $_GET["parent"]; 
  $category_parent2 = $_GET["parent2"]; 
  $category_chinese_name = $_GET["chinese"]; 
  
  
  if ($category_parent == NULL AND $category_parent2 == NULL) {
    $category = "'$category_name'"; 
    $subcategory = "NULL"; 
    $subcategory2 = "NULL"; 
  }
  
  else if ($category_parent != NULL AND $category_parent2 == NULL){
    $category = "'$category_parent'"; 
    $subcategory = "'$category_name'";
    $subcategory2 = "NULL";  
  }
  
  else if ($category_parent != NULL AND $category_parent2 != NULL) {
    $category = "'$category_parent2'"; 
    $subcategory = "'$category_parent'"; 
    $subcategory2 = "'$category_name'"; 
  }
    
  echo 
  "<div class='container mt-3 w-75'>
    <h1>$category_name ($category_chinese_name)</h1>
    <table class='table table-bordered border-dark text-black mt-4 mb-5'>
    <tr class='table-heading'>
      <th>Trad. Chinese<br>正體中文</th>
      <th>Jyutping<br>粵拼</th>
      <th>Pinyin<br>拼音 </th>
      <th>English<br>英文</th>
    </tr>"; 
  
  if ($subcategory2 == "'States'") {
    $order = "priority ASC, english";
  }
  else {
    $order = "length(chinese), priority DESC, jyutping";
  }

  $query = "SELECT * FROM vocabulary 
            WHERE category IS $category 
            AND subcategory IS $subcategory 
            AND subcategory2 IS $subcategory2
            ORDER BY $order";
  
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

  echo "</table></div>";
  ?>
</body>

</html>

