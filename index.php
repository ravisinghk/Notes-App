

<?php
// $title = "";
$insert = false;
$con ="";
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "notes";


    // create databse connection
    $con = mysqli_connect($server, $username, $password, $dbname);

    if(!$con){
        die("Connection failed". mysqli_connect_error());
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $description = $_POST['desc'];

    $sql1 = "INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, '$title', '$description', current_timestamp())";
    $result = mysqli_query($con, $sql1);

    if($result){
      // echo "The record has been inserted successfully!<br>";
        $insert = true;
    }
    else{
      echo "Record Insertion Failed!<br>";

    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    

    <title>My Notes</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">My Notes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

      <?php
       if($insert){
         echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
         <strong>Success!</strong>Note Added Successfully.
         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
       </div>";
       }
      ?>

<!-- <div class="container my-3 "  > -->

 <div class="container my-3  w-50 p-3>
     <h3>My Notes</h3>
    <form action="/notes/index.php" method="post">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Note Title</label>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Note Description</label>
          <textarea class="form-control" placeholder="Write your note here!" id="desc" name="desc" style="height: 100px"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
      </form>


 </div>


<div class="container  my-3  w-50 p-3">
    

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $sql = "SELECT * FROM `notes`";
    $result = mysqli_query($con, $sql);
      $sno = 0;
    while($row = mysqli_fetch_assoc($result)){
      // echo $row['sno']. $row['title']. $row['description'];
      // echo "<br>";
      $sno = $sno + 1;
      echo "<tr>
      <th scope='row'>".$sno."</th>
      <td>".$row['title']."</td>
      <td>".$row['description']."</td>
      <td>Action</td>
    </tr> ";
    }  
?>

</tbody>
</table>

</div>
      
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
      $(document).ready( function () {
    $('#myTable').DataTable();
      } );
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>