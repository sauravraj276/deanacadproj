<?php
//get all the data of previous sem
//program,set previous sem id equal to sem id , semno., year
//to create new sem
//set new sem ensure that the sem no +1 is less than program sem
//change year if sem no is even
//sem_no update to sem no +1
//set progress to 0
//after insertion get the new sem id 

//from that program schema add all the courses to the courses_semester table
//with the sem id

//add an tab to create 1st sem with null previous sem

// if an student registers update his sem_id
// and add him to the courses register table {gives flexiblity to add courses outside his 
// program} with those course id

//Create Sem Function
//Only 1 st sem can be created
//create_sem(prog_id,year,)->return new_sem_id;
//	
// sem_id -> auto
// prev_sem_id -> null
// progress -> now 0 and 3 after addition of admission portal
// program -> program_id eg. 5
// sem_no -> 1
// year -> input eg. 2020

//Calculate Pointer

function sum_marks($json_marks)
{
    $ans = 0;
    $marks = json_decode($json_marks, TRUE);
    foreach ($marks as $k => $mark) {
        $ans = $ans + $mark;
    }
    return $ans;
}

//Calculate spi
//acc to total marks and marks obtained and ordinance for btech
//courses students id
function spi($max_marks, $marks)
{
    $per_marks = ($marks / $max_marks) * 100;
    if ($per_marks >= 85) {
        $point = 10;
        $grade = "A+";
    } else {
        if ($per_marks >= 75) {
            $point = 9;
            $grade = "A";
        } else {
            if ($per_marks >= 65) {
                $point = 8;
                $grade = "B+";
            } else {
                if ($per_marks >= 55) {
                    $point = 7;
                    $grade = "B";
                } else {
                    if ($per_marks >= 45) {
                        $point = 6;
                        $grade = "C";
                    } else {
                        if ($per_marks >= 30) {
                            $point = 4;
                            $grade = "D";
                        } else {
                            if ($per_marks >= 15) {
                                $point = 2;
                                $grade = "E";
                            } else {

                                $point = 0;
                                $grade = "F";
                            }
                        }
                    }
                }
            }
        }
    }
    return [$point, $grade];
}
//Register students to all the courses
function reg_student($reg_no, $sem_id)
{
    //get list of all the courses in course-sem table having sem_id
    include './config/config.php';
    $sql = "SELECT `id` FROM `course_sem` WHERE sem_id=$sem_id";
    $result = $conn->query($sql);
    $cs_ids = $result->fetch_all();

    //Add student to all the courses
    foreach ($cs_ids as $cs_id) {
        $sql = "INSERT INTO `courses_students`(`reg_no`, `cs_id`, `sem_id`) 
        VALUES ('$reg_no','$cs_id[0]','$sem_id')";
        $result = $conn->query($sql);
    }
}
//Calculate cpi
//acc to courses and credit
//reg_no,semester_no,spi array
function update_cpi($reg_no,$sem_no){
    include './config/config.php';
    $sql="SELECT * from `spi` where reg_no=$reg_no";
    $result=$conn->query($sql);
    $row=$result->fetch_all();

}
//Add all subjects to courses-sem db

//Add students to supplimentry exam db

//Register students to courses
