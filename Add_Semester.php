<?php
$pageuser = 'Admin';
include './pagePartials/Session_Validator.php';

$title = "Admin_Dashboard";
include './pagePartials/header.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['program_id']) && isset($_POST['year'])) {
        $year=$_POST['year'];
        $id=$_POST['program_id'];
        
        include './config/config.php';
        //if there is a program in that year having sem id then dont insert
        $sql = "SELECT * FROM `semester` WHERE program='$id' AND year='$year' and sem_no=1" ;
        $result = $conn->query($sql);
        
        if ($result->num_rows == 0){
            $sql = "INSERT INTO `semester`(`progress`, `program`, `sem_no`, `year`) VALUES (0,'$id',1,'$year')";
            $result = $conn->query($sql);
            $new_sem_id=$conn->insert_id;

            //Add all the courses from courses-structure of program to courses-sem
            //where program_id and sem_no is provided
            $sql = "SELECT `course_code`,`credit` FROM `program_structure` WHERE program_id='$id' AND semester=1";
            $result = $conn->query($sql);
            $row=$result->fetch_all();

            //add each course to courses-sem database
            foreach($row as $r){
                $course_code=$r[0];
                $credit=$r[1];
                $sql = "INSERT INTO `course_sem`(`course_code`, `credit`, `sem_id`) VALUES 
                            ('$course_code','$credit','$new_sem_id')";
                $result = $conn->query($sql);

            }
            

        }
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



            <div class="col-9 d-flex flex-column justify-content-around" style="height:90vh; border: 1px solid red;">

                <div class="row">
                    <div class="col d-flex flex-column justify-content-center align-items-center" style="height:70vh; border: 1px solid red;">
                        <?php
                        //connection module is included
                        include './config/config.php';
                        $sql = "SELECT * FROM `semester`";
                        $result = $conn->query($sql);
                        $semesters = $result->fetch_all();
                        // print_r($semesters);

                        $sql = "SELECT * FROM `programs`";
                        $result = $conn->query($sql);
                        $programs = $result->fetch_all();
                        // print_r($programs);
                        ?>
                        <form name="myform" class="p-3" style="border: 1px solid red;" method="POST">
                            <h2>Create 1st sem of program</h2>

                            <label for="program">Program</label>
                            <select class="form-control form-control-lg" name="program_id" id="program" required>
                                <?php
                                foreach ($programs as $program) {
                                    echo '<option value=' . $program[0] . '>' . $program[4] . '-' . $program[1] . '</option>';
                                }
                                ?>
                            </select>

                            <div class="form-group">
                                <input required name="year" type="number" class="form-control" placeholder="Enter Semester Year">
                                <small class="form-text text-muted">Enter the year of the semester</small>
                            </div>
                            <button type="submit" class="btn btn-danger">Add 1st Semester</button>
                        </form>

                    </div>
                    <div class="col-4 d-flex flex-column justify-content-around" style="height:70vh; border: 1px solid red;">
                        <h4 class="border-bottom border-danger">Active semesters</h4>
                        <div class="justify-content-center allign-self-center overflow-auto">

                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">sem_no</th>
                                        <th scope="col">Program</th>
                                        <th scope="col">year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($semesters as $semester) {
                                        if($semester[2]<16)
                                        echo '<tr>
                                        <th scope="row">' . $semester[4] . '</th>
                                        <td>' . $semester[3] . '</td>
                                        <td>' . $semester[5] . '</td>
                                    </tr>';
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</body>

</html>