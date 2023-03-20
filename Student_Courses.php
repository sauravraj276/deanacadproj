<?php 

$pageuser='Student';
include './pagePartials/Session_Validator.php';

$title = "Student_Dashboard";
include './pagePartials/header.php'; ?>

<body>
  <div class="container text-center">
    <div class="row gy-5" style="border: 1px solid red;">
      <h1>Current semester :- ______</h1>
    </div>
    <div class="row gx-5" style="border: 1px solid red;">
      <?php $user = 'Student';
      include './pagePartials/leftBar.php'; ?>
      <div class="col-9 d-flex flex-column justify-content-center align-items-center" style="height:90vh; border: 1px solid red;">
        <h2>Current Courses</h2>
        <div class="col-6 justify-content-center allign-self-center" >
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">Code</th>
                <th scope="col">Course Name</th>
                <th scope="col">Credit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if(!isset($_SESSION['courses'])){
              $uid_no = $_SESSION['student']['reg_no'];
              $curr_sem_id=$_SESSION['student']['sem_id'];
              //connection module is included
              include './config/config.php';
              $sql = "SELECT *
              FROM `current_courses_view` WHERE reg_no='$uid_no' AND sem_id='$curr_sem_id'";
              $result = $conn->query($sql);
              $_SESSION['courses']=array();
              while (($row = $result->fetch_assoc()) != null){
                array_push($_SESSION['courses'],$row);
              }}
              foreach ($_SESSION['courses'] as $course){
                echo 
                '<tr>
                <th scope="row">'.$course['code'].'</th>
                <td>'.$course['course_name'].'</td>
                <td>'.$course['credit'].'</td>
              </tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</body>

</html>