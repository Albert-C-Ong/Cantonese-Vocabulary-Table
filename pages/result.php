<?php
/* result.php
 *
 * Written by Albert Ong
 */ 
?>

<html>

<head>
  <title>Cantonese Vocabulary Table | 廣東話詞彙圖表</title>
  
  <link rel="icon" type="image/png" href="../assets/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <style>
    .table-heading {
        background-color: lightgray;
    }
    .text-black {
      color: black;
    }
    .w-65 {
      width: 65%;
    }
    h1 {
      color: black;
    }
  </style>
</head>

<body>
<div class="mx-5 mt-4">
  <a href="search.php">← Back</a>
</div>

<h1 class="text-center mt-3">Result</h1>

<div class="container mt-4 w-65">
  <table class="table table-bordered border-dark text-black rounded text-center">
    <thead>
      <tr class="table-heading fs-6">
        <th>Trad. Chinese<br>正體中文</th>
        <th>Jyutping<br>粵拼</th>
        <th>Pinyin<br>拼音 </th>
        <th>English<br>英文</th>
      </tr>
    </thead>

    <tbody>
    <?php
    $db = new SQLite3('../database/database.db');

    $column = $_GET["column"];
    $search_word = $_GET["search-word"];
    $query = "SELECT * FROM vocabulary 
              WHERE $column LIKE '%$search_word%' 
              ORDER BY LENGTH(chinese), jyutping";
    
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
    ?>
      <!-- <tr>
        <td>Row 1, Cell 1</td>
        <td>Row 1, Cell 2</td>
        <td>Row 1, Cell 3</td>
        <td>Row 1, Cell 4</td>
      </tr>
      <tr>
        <td>Row 2, Cell 1</td>
        <td>Row 2, Cell 2</td>
        <td>Row 2, Cell 3</td>
        <td>Row 2, Cell 4</td>
      </tr>
      <tr>
        <td>Row 3, Cell 1</td>
        <td>Row 3, Cell 2</td>
        <td>Row 3, Cell 3</td>
        <td>Row 3, Cell 4</td>
      </tr>
      <tr>
        <td>Row 4, Cell 1</td>
        <td>Row 4, Cell 2</td>
        <td>Row 4, Cell 3</td>
        <td>Row 4, Cell 4</td>
      </tr> -->
    </tbody>
  </table>
</div>

</body>

</html>