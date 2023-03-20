<?php
$sem;
if (isset($_GET['s'])) {
    $myData = json_decode(base64_decode($_GET['s']), true);
    if (isset($myData)) {
        $sem = $myData;
    }
}
//update sem progress function
if (isset($_GET['p'])) {
    $progress = $_GET['p'];
    include './config/config.php';
    include './pagePartials/functions.php';
    $sem_id = $sem['sem_id'];

    //Declare result
    if ($progress == 9) {
        //Get list of students whos curr_sem_id is this sem_id
        $sql = "SELECT reg_no FROM `students` where curr_sem_id=$sem_id";
        $result = $conn->query($sql);
        $reg_nos = $result->fetch_all();


        //for each student calculate spi and update, also update cpi
        foreach ($reg_nos as $row) {
            $reg_no = $row[0];
            $sql = "SELECT credit,pointer FROM `current_courses_view` where reg_no=$reg_no and sem_id=$sem_id";
            $result = $conn->query($sql);
            $row = $result->fetch_all();
            $total_credit = 0;
            $spi = 0;
            foreach ($row as $r) {
                print_r($r);
                $total_credit += $r[0];
                $spi += $r[0] * $r[1];
            }
            $spi = $spi / $total_credit;
            $sem_no = $sem['sem_no'];
            //add to spi database
            $sql = "INSERT INTO `spi`(`reg_no`, `gpa`, `total_credits`, `sem_no`, `sem_id`) 
            VALUES ('$reg_no','$spi','$total_credit','$sem_no','$sem_id')";
            $result = $conn->query($sql);

            //calculate cpi and update in database
            //update_cpi($reg_no,1);


        }
    }
    // update semester table;
    $sql = "UPDATE `semester` SET `progress`='$progress' WHERE `sem_id`=$sem_id";
    $result = $conn->query($sql);
    $conn->close();
    $sem['progress'] = $progress;
}


$pageuser = 'Admin';
include './pagePartials/Session_Validator.php';

//Change title to semester data
$title = "Admin_Dashboard";
include './pagePartials/header.php';


//Sem Progress logic is calculated with this function.
function sem_progress($progress, $max_sem, $curr_sem)
{
    // semester created : 0 ;
    // if(sem==odd)
    //      admission started : 1;
    //      admission closed : 2; {automatically register admitted student to 1st year odd semester}
    // semester registration open for student - 3 
    // semester registration closed for student - 4
    // portal open for professor registration to courses of this semester - 5
    // portal closed for professor registration for this semester - 6
    // portal open for marking entry - 7
    // portal closed for marks entry - 8
    // result declared and added to database - 9
    // if(sem==even)
    //      portal open for supplementary exam registration for failed students - 10
    //              portal open for all subjects he failed that year or previous year
    //      portal closed for supplementary exam registration - 11
    //      portal open for marks input of supplementary exam - 12
    //      portal closed for marks input of supplementary exam - 13
    //      supplementary exam result declared grade updated in database - 14
    // publish result - 15
    // semester completed - 16

    // if sem no is 1 directly after close semester 
    // go to open marks

    $i = 1;
    if ($curr_sem == 1 && $progress == 2) {
        $i = 3;
    }
    if ($progress == 9) {
        $i = 7;
    }
    return ($progress + $i);
}
?>

<body>
    <div class="container text-center">

        <div class="row gy-5" style="border: 1px solid red;">
            <h1>MNNIT ADMIN PANEL</h1>
        </div>

        <div class="row gx-5" style="border: 1px solid red;">
            <!-- Left side bar is included -->

            <?php $user = '';
            include './pagePartials/leftBar.php'; ?>



            <div class="col-9 d-flex flex-column justify-content-around" style="height:90vh; border: 1px solid red;">

                <div class="row">
                    <div class="col d-flex flex-column justify-content-center align-items-center" style="height:70vh; border: 1px solid red;">
                        <?php
                        //Get btn details from db
                        //call progress fuction to get the next progress number
                        $nxt_progress = sem_progress($sem['progress'], 8, $sem['sem_no']);

                        include './config/config.php';
                        $sql = "SELECT `btn` FROM `progress` WHERE `status code`=$nxt_progress";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        //Get Current status of semester
                        $progress = $sem['progress'];
                        $sql = "SELECT `text` FROM `progress` WHERE `status code`=$progress";
                        $result = $conn->query($sql);
                        $conn->close();
                        $row1 = $result->fetch_assoc();
                        print_r($progress);


                        echo '
                        <p >
                            <span>
                                <b>Program</b> : ' . $sem['name'] . '
                            <br></span>
                            <span>
                                Sem No. : ' . $sem['sem_no'] . '
                            <br></span>
                            <span>
                                Year : ' . $sem['year'] . '
                            <br></span>
                            <span>
                                Degree : ' . $sem['degree_name'] . '
                            <br></span>
                            <span>
                                Duration : ' . $sem['duration'] . 'years
                            <br></span>
                            <span>
                                level : ' . $sem['type'] . '
                            <br></span>
                            <span>
                                Department : ' . $sem['department_code'] . '
                            <br></span>
                            <span>
                                Current Status : ' . $row1['text'] . '
                            <br></span>
                        </p>
                        <a href="Admin_Semester.php?s=' . $_GET['s'] . '&p=' . $nxt_progress . '"><button type="button" class="btn btn-primary btn-sm">' . $row['btn'] . '</button></a>
                        '
                        ?>
                    </div>
                    <?php $user = '';
                    include './pagePartials/seminfo.php'; ?>
                </div>

            </div>

        </div>
    </div>

</body>

</html>