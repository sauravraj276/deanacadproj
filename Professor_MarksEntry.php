<?php

$pageuser = 'Professor';
include './pagePartials/Session_Validator.php';

$title = "Marks Entry";
include './pagePartials/header.php';

// json check function
function isJson($string)
{
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}

//add marks to courses students table
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['courses_students_id'])) {
        include './config/config.php';
        include './pagePartials/functions.php';
        foreach ($_POST['courses_students_id'] as $cs_id) {
            $marks = $_POST[$cs_id];
            $marking_scheme = $_POST['' . $cs_id . '_marking_scheme'];
            if (isJson($marks)) {
                $pointer = spi(sum_marks($marking_scheme), sum_marks($marks))[0];
                $grade = spi(sum_marks($marking_scheme), sum_marks($marks))[1];
                // Update in student courses database
                $sql = "UPDATE `courses_students` SET marks='$marks',pointer='$pointer',grade='$grade' WHERE id='$cs_id'";
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

                <b>The marks entry will be sorted by branch and courses with marking scheme</b>

                <h2 class="border-bottom">Enter Marks of Course</h2>

                <form class="form-group overflow-auto" method="POST" style="height:80vh" ;>
                    <table class="table">

                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Reg no.</th>
                                <th scope="col">Course</th>
                                <th scope="col">Marking Scheme</th>
                                <th scope="col">Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            $prof_id = $_SESSION['professor']['prof_id'];

                            //connection module is included
                            include './config/config.php';
                            $sql = "SELECT *
                            FROM `professor_course_view`,`current_courses_view` WHERE 
                            code=course_code and prof_id='$prof_id ' and progress=7 ";
                            $result = $conn->query($sql);
                            $conn->close();
                            while (($row = $result->fetch_assoc()) != null) {
                                echo
                                '<tr>
                              <th scope="row"><input class="form-check-input" type="checkbox" value="' . $row['courses_students_id'] . '" name="courses_students_id[]"></th>
                              <td>' . $row['reg_no'] . '</td>
                              <td>' . $row['course_name'] . '-' . $row['course_code'] . '</td>
                              <td><div class="form-group">
                              <textarea class="form-control"  rows="3" readonly name="' . $row['courses_students_id'] . '_marking_scheme"> ' . $row['marking_scheme'] . '</textarea>
                            </div> </td>
                              <td><div class="form-group">
                              <textarea class="form-control" name=' . $row['courses_students_id'] . ' rows="3">' . $row['marks'] . '</textarea>
                            </div> </td>
                          </tr>';
                            }
                            ?>

                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary mb-2">Submit Marks</button>
                </form>
            </div>
        </div>

    </div>
    </div>

</body>

</html>