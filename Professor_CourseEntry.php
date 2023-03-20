<?php

$pageuser = 'Professor';
include './pagePartials/Session_Validator.php';

$title = "course entry";
include './pagePartials/header.php';

// json check function
function isJson($string)
{
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}


//add professor_id to course of current semester in db
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prof_id = $_SESSION['professor']['prof_id'];
    if (isset($_POST['course_sem_id'])) {
        include './config/config.php';
        foreach ($_POST['course_sem_id'] as $cs_id) {
            $marking_scheme = $_POST[$cs_id];
            if (isJson($marking_scheme)) {
                $sql = "UPDATE `course_sem` SET `prof_id`='$prof_id', `marking_scheme`='$marking_scheme'WHERE id=$cs_id";
                $result = $conn->query($sql);
            }
        }
        //close connection
    }
}

?>

<body>
    <div class="container text-center">

        <div class="row gy-5" style="border: 1px solid red;">
            <h1>Current semester :- ______</h1>
        </div>

        <div class="row gx-5" style="border: 1px solid red;">
            <!-- Left side bar is included -->

            <?php $user = '';
            include './pagePartials/leftBar.php'; ?>

            <div class="col-9 d-flex flex-column justify-content-center " style="height:90vh; border: 1px solid red;">

                <p>default marking scheme 1<br>{"mid-sem" : 20,
                    "TA" : 20,
                    "end-sem" : 60}</p>
                <p>default marking scheme 2<br>{"internal" : 50,
                    "external" : 50}</p>
                <h2 class="border-bottom">Select Courses</h2>
                <form method="POST">
                    <table class="table overflow-auto">

                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Course Code</th>
                                <th scope="col">Course Name</th>
                                <th scope="col">Program</th>
                                <th scope="col">Semester</th>
                                <th scope="col">marking_scheme</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            $department = $_SESSION['professor']['department_code'];

                            //connection module is included
                            include './config/config.php';
                            $sql = "SELECT *
                            FROM `professor_course_view` WHERE department='$department' and prof_id is null and progress='5'";
                            $result = $conn->query($sql);
                            $conn->close();
                            while (($row = $result->fetch_assoc()) != null) {
                                echo
                                '<tr>
                              <th scope="row"><input class="form-check-input" type="checkbox" value="' . $row['course_sem_id'] . '" name="course_sem_id[]"></th>
                              <td>' . $row['course_code'] . '</td>
                              <td>' . $row['course_name'] . '</td>
                              <td>' . $row['degree'] . '-' . $row['program'] . '</td>
                              <td>' . $row['semester'] . '</td>
                              <td><div class="form-group">
                              <textarea class="form-control" name=' . $row['course_sem_id'] . ' rows="3"></textarea>
                            </div> </td>
                          </tr>';
                            }
                            ?>

                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary mb-2">Register for Courses</button>
                </form>
            </div>

        </div>
    </div>

</body>

</html>