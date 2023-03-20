<?php 

$pageuser='Student';
include './pagePartials/Session_Validator.php';

$title = "Prev Semester Performance";
include './pagePartials/header.php'; 

// 

?>

<body>
  <div class="container text-center">
    <div class="row gy-5" style="border: 1px solid red;">
      <h1>Current semester :- ______</h1>
    </div>
    <div class="row gx-5" style="border: 1px solid red;">
      <?php $user = 'Student';
      include './pagePartials/leftBar.php'; ?>
      <div class="col-9 d-flex flex-column align-items-center overflow-auto" style="height:90vh; border: 1px solid red;">
        <h2>Transcript</h2>
        <div class="col-6 overflow-auto">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">Code</th>
                <th scope="col">Course Name</th>
                <th scope="col">Credit</th>
                <th scope="col">Grade</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">HS15101</th>
                <td>Principles of Management</td>
                <td>3</td>
                <td>B</td>
              </tr>
              <tr>
                <th scope="row">ME15101</th>
                <td>Computer Aided Design</td>
                <td>4</td>
                <td>B+</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">Code</th>
                <th scope="col">Course Name</th>
                <th scope="col">Credit</th>
                <th scope="col">Grade</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">HS15101</th>
                <td>Principles of Management</td>
                <td>3</td>
                <td>B</td>
              </tr>
              <tr>
                <th scope="row">ME15101</th>
                <td>Computer Aided Design</td>
                <td>4</td>
                <td>B+</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">Code</th>
                <th scope="col">Course Name</th>
                <th scope="col">Credit</th>
                <th scope="col">Grade</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">HS15101</th>
                <td>Principles of Management</td>
                <td>3</td>
                <td>B</td>
              </tr>
              <tr>
                <th scope="row">ME15101</th>
                <td>Computer Aided Design</td>
                <td>4</td>
                <td>B+</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">Code</th>
                <th scope="col">Course Name</th>
                <th scope="col">Credit</th>
                <th scope="col">Grade</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">HS15101</th>
                <td>Principles of Management</td>
                <td>3</td>
                <td>B</td>
              </tr>
              <tr>
                <th scope="row">ME15101</th>
                <td>Computer Aided Design</td>
                <td>4</td>
                <td>B+</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
          <?php include './pagePartials/spiTable.php'; ?>

        </div>
      </div>
    </div>
  </div>

</body>

</html>