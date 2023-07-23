<?php
/* search.php
 *
 * Written by Albert Ong
 */ 
?>

<html>

<head>
  <title>Cantonese Vocabulary Table | 廣東話詞彙圖表</title>
  
  <!-- <link rel="stylesheet" type="text/css" href="../assets/master.css"> -->
  <link rel="icon" type="image/png" href="../assets/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  
  <style>
    .mt-10 {
        margin-top: 10rem;
    }
  </style>
</head>

<body>
<h1 class="text-center mt-5">Search</h1>

<div class="container">
  <div class="row justify-content-center mt-10">
    <div class="col-md-7">
      <form action="result.php" method="get">
        <div class="input-group">
          <select class="form-select border" name="column">
            <option value="english">English</option>
            <option value="chinese">Chinese</option>
          </select>
          <input type="text" class="form-control border" name="search-word" placeholder="Search..." style="width: 65%" required>
          <button type="submit" class="btn btn-light border">
            <img src="../assets/search_icon.png" alt="Icon Image" height="20px">
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>

</html>