<?php

$pageuser = 'Professor';
include './pagePartials/Session_Validator.php';

$title = "Professors_Dashboard";
include './pagePartials/header.php'; ?>

<body>
    <div class="container text-center">

        <div class="row gy-5" style="border: 1px solid red;">
            <h1>Current semester :- ______</h1>
        </div>

        <div class="row gx-5" style="border: 1px solid red;">
            <!-- Left side bar is included -->

            <?php $user = '';
            include './pagePartials/leftBar.php'; ?>

            <div class="col-9 d-flex flex-column justify-content-around overflow-auto" style="height:90vh; border: 1px solid red;">
                <div class="row">
                    <h2>Welcome to Professor's dashbord</h2>
                </div>
                <!-- if progress is 5 -->
                <?php
                //check database if any semester have progress=5 and is of professors department
                //show appropriate output for intermediate values
                //connection module is included
                // include './config/config.php';
                // $department_code = $_SESSION['professor']['department_code'];
                // $sql = "SELECT * 
                //     FROM `semester`,`programs` WHERE programs.id=program and department_code='$department_code'";
                // $result = $conn->query($sql);
                // //count number of semesters having progress 5 and 7
                // $row = $result->fetch_all();
                // $progress5=0;
                // $progress7=0;
                // foreach($row as $r){
                //     if($r[2]=="5")$progress5++;
                //     if($r[2]=="7")$progress7++;
                // }
                // if($progress5>0){
                    echo '<div class="row" style="border: 1px solid red; height:10vh ; width:20vw"><a href="Professor_CourseEntry.php">Enter the Course for current sem</a>
                    </div>';
                // }
                // if($progress7>0){
                    echo '<div class="row" style="border: 1px solid red; height:10vh ; width:20vw"><a href="Professor_MarksEntry.php">Enter marks of each student</a>
                    </div>';

                // }
                ?>
                

                <div class="row" style="border: 1px solid red; height:10vh ; width:20vw"><a href="Professor_Courses.php">Get my courses of current sem</a>
                </div>
            </div>

        </div>
    </div>

</body>

</html>