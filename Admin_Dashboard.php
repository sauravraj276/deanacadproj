<?php
$pageuser = 'Admin';
include './pagePartials/Session_Validator.php';

$title = "Admin_Dashboard";
include './pagePartials/header.php';

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
                    <h2>Welcome to Admin dashbord</h2>
                </div>

                <div class="row d-flex justify-content-center overflow-auto">
                    <h4>Active semesters</h4>

                    <div class="col-8 " style="height:70vh; border: 1px solid red;">
                        <?php
                        $department_id=$_SESSION['professor']['department_code'];
                        
                        // if semester is not set
                        // select all the semester which are not completed
                        //from semester table whose progress is less than 13
                        //connection module is included
                        include './config/config.php';
                        $sql = "SELECT * FROM `programs`,`semester` WHERE programs.id=semester.program AND progress<16";
                        $result = $conn->query($sql);
                        $conn->close();
                        while (($row = $result->fetch_assoc()) != null) {
                            $myData = $row;
                            $arg = base64_encode(json_encode($myData));
                            echo '<div class="row" style="border: 1px solid red; height:5vh; border-collapse: collapse; "><a href="Admin_Semester.php?s=' . $arg . '">' . $row['year'] . '-sem-' . $row['sem_no'] . '-' . $row['degree_name'] . '-' . $row['name'] . '</a>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
</body>
</html>