<?php
/* search.php
 *
 * Written by Albert Ong
 */ 
?>

<html>

<head>
<title>Cantonese Vocabulary Table | Search</title>

<link rel="icon" type="image/png" href="../assets/favicon.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../assets/custom.css">
</head>

<body>
<div class="mx-5 mt-4">
  <a href="homepage.php">← Home</a>
</div>

<div class="container d-flex justify-content-center align-items-center h-75">
  <div class="row d-flex align-items-center">
    <div class="col align-items-center text-center mb-3">
      <img class="mb-4 logo" src="../assets/logo.png" alt="logo">
      <h1 class="d-inline search-heading">Search</h1>
    </div>
    <div class="row align-items-start mt-3 mb-8">
      <form action="result.php" method="get">
        <div class="input-group" style="height: 45px;">
          <select class="form-select border" name="column">
            <option value="english">English</option>
            <option value="chinese">Chinese</option>
          </select>
          <input type="text" class="form-control border" name="search-word" placeholder="Search..." style="width: 65%" required>
          <button type="submit" class="btn btn-light border">
            <img src="../assets/search_icon.png" alt="search icon" height="22px">
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- <div class="container">
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
            <img src="../assets/search_icon.png" alt="search icon" height="20px">
          </button>
        </div>
      </form>
    </div>
  </div>
</div> -->
</body>

</html>