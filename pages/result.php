<!--
/* result.php
 *
 * Written by Albert Ong
 */ 
-->

<html>

<head>
<title>Cantonese Vocabulary Table | Result</title>

<link rel="icon" type="image/png" href="../assets/favicon.png">
<link rel="stylesheet" type="text/css" href="../assets/master.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../assets/custom.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light pt-3">
  <div class="mx-5 mb-4">
    <a href="search.php">← Back</a>
  </div>
  <form class="mt-3" action="result.php" method="get" style="width: 40%;">
    <div class="input-group" style="height: 45px;">
      <select class="form-select border" name="column">
        <option value="english">English</option>
        <option value="chinese">Chinese</option>
      </select>
      <input type="text" class="form-control border w-50" name="search-word" placeholder="Search..." style="width: 65%" required>
      <button type="submit" class="btn btn-light border">
        <img src="../assets/search_icon.png" alt="search icon" height="22px">
      </button>
    </div>
  </form>
</nav>

<?php
$db = new SQLite3('../database/database.db');

$column = $_GET["column"];
$search_word = $_GET["search-word"];

$count_query = "SELECT COUNT(*) FROM vocabulary 
                WHERE $column LIKE '%$search_word%'";
$count = $db -> query($count_query) -> fetchArray()[0];

$has_result = $count != 0;

if ($has_result) {
  
  echo "<h1 class='mt-4'>Result</h1>
        <div class='container mt-3 w-65'>
        <table class='table table-bordered border-dark text-black'>
          <thead>
            <tr class='table-heading fs-6'>
              <th>Trad. Chinese<br>正體中文</th>
              <th>Jyutping<br>粵拼</th>
              <th>Pinyin<br>拼音 </th>
              <th>English<br>英文</th>
            </tr>
          </thead>";

  $query = "SELECT * FROM vocabulary 
            WHERE $column LIKE '%$search_word%' 
            ORDER BY LENGTH(chinese), jyutping";

  $res = $db -> query($query);

  while ($word = $res -> fetchArray()) {

    // TODO

    // $column_names = array($chinese, $chinese_variation, $jyutping, $pinyin, 
    //                       $english, $category, $subcategory, $subcategory2);
    
    // foreach ($column_names as $index => $column_name) {

    //   if ($column == "$chinese_variation") {
    //     ${$column} = $word[$index] != null ? "<br>" . $word[$index] : null; 
    //   }
    //   else {
    //     ${$column} = $word[$index];
    //   }
    // }

    $chinese = $word[0];
    $chinese_variation = $word[1] != null ? "<br>" . $word[1] : null; 
    $jyutping = $word[2];
    $pinyin = $word[3];
    $english = $word[4]; 

    $category = $word[5];
    $subcategory = $word[6];
    $subcategory2 = $word[7];

    $categories = array_filter(array($category, $subcategory, $subcategory2));
    $categories_string = join(", ", $categories);
  
    echo "<tr> 
            <td>$chinese$chinese_variation</td> 
            <td>$jyutping</td> 
            <td>$pinyin</td>
            <td>$english<img class='float-end' title='$categories_string' src='../assets/info_icon.png' height='22px'></td> 
          </tr>";
  }
}

else {
  echo "<div class='text-center d-flex justify-content-center align-items-center h-50'>
          <div>
            <h1 class='text-center'>‾\_(ツ)_/‾</h1>
            <h3 class='text-center mt-3'>no results found</h3>
          </div>
        </div>";
}

?>
</body>

</html>