<?php
$pageuser = 'Student';
include './pagePartials/Session_Validator.php';

$title = "Student_Dashboard";
include './pagePartials/header.php'; ?>

<body>
  <div class="container text-center">

    <div class="row gy-5 " style="border: 1px solid red;">
      <h1>Current semester :- <?php echo $_SESSION['student']['curr_semester']; ?></h1>
    </div>

    <div class="row gx-5" style="border: 1px solid red;">
      <!-- Left side bar is included -->

      <?php $user = 'Student';
      include './pagePartials/leftBar.php'; ?>

      <div class="col-9 d-flex flex-column justify-content-around" style="height:90vh; border: 1px solid red;">
        <div class="row">
          <h2>Welcome to Student's dashbord</h2>
          <!-- Spi table history is included -->
          <?php include './pagePartials/spiTable.php'; ?>
        </div>

        <div class="row" style="border: 1px solid red; height:10vh ; width:20vw"><a href="Student_Registration.php">Sem Registration</a>
          </div>
        <div class="row" style="border: 1px solid red; height:10vh ; width:20vw"><a href="Student_Transcript.php">View Result</a>
        </div>
        <div class="row" style="border: 1px solid red; height:10vh ; width:20vw"><a href="Student_PrevPer.php">Prev Semester performance</a>
        </div>
        <div class="row" style="border: 1px solid red; height:10vh ; width:20vw"><a href="Student_Courses.php">Get my courses of current sem</a>
        </div>
      </div>

    </div>
  </div>

</body>

</html>