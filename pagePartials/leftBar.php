<div class="col d-flex flex-column justify-content-center align-items-center" style="border: 1px solid red;">
    <div class="w-100" style="height:15vh">
        <!-- Show home btn only if user is not on Dashboard Page -->
        <?php if (!str_contains($_SERVER['REQUEST_URI'], 'Dashboard.php')) echo '<a href="/deanacadproj/' . $_SESSION['user'] . '_Dashboard.php"><button class="btn btn-outline-danger w-100">Home</button></a>';
        else 
        if ($pageuser == 'Admin')
        echo '
            <a href="Add_Semester.php"><button class="btn btn-outline-danger w-100">Add Semester</button></a><br>
            ';
        ?>

        <a href="logout.php"><button class="btn btn-outline-danger w-100">logout</button></a><br>

    </div>

    <div class="d-flex justify-content-center p-2 rounded m-2" style="border: 3px double red; height:10vw; width:10vw ;">
        <img src="./img/no-profile-picture-icon.svg" alt="student-img"><br>
    </div>
    <div class="p-2 m-2 w-100 rounded" style="border: 1px solid red;">
        <?php
        if ($pageuser == 'Student') {
            echo '<h4 class="border-bottom border-danger">Student details</h4>
            <p><b>Name : </b>' . $_SESSION['student']['name'] . '<br>
            <b>Registration no. - </b>' . $_SESSION['student']['reg_no'] . ' <br>
            <b>Program - </b>' . $_SESSION['student']['degree'] . '-' . $_SESSION['student']['program_name'] . '<br>
            <b>Semester - </b>' . $_SESSION['student']['curr_semester'] . '<br> 
            <b>Student since. - </b>' . $_SESSION['student']['admission_year'] . '</P>
            ';
        } else {
            echo '<h4 class="border-bottom border-danger">Professor details</h4>
            <p><b style="float:left">Name : </b>' . $_SESSION['professor']['name'] . '<br>
            <b style="float:left">Professor id. : </b>' . $_SESSION['professor']['prof_id'] . ' <br>
            <b style="float:left">Department : </b>' . $_SESSION['professor']['department_code'] . ' <br>
            <b style="float:left">Registered since : </b>' . $_SESSION['professor']['joined_on'] . '</P>

            ';
        }
        ?>

    </div>

</div>