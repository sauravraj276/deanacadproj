<?php
$pageuser = 'Student';
include './pagePartials/Session_Validator.php';

$title = "Semester_Registration";
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

            <div class="col-9 d-flex flex-column justify-content-center" style="height:90vh; border: 1px solid red;">

                <div class="row d-flex flex-column justify-content-center align-items-center">
                    <?php 
                    // get details of sem whose previous sem is this sem
                    
                    
                    ?>

                    <form name="myform" class="p-3" style="width:22vw; border: 1px solid red;" method="POST">
                        <h2>Register</h2>
                        <div class="d-flex flex-row justify-content-around">
                            <button type="submit" class="btn btn-danger">Register</button>
                    </form>
                </div>

            </div>
        </div>

</body>

</html>