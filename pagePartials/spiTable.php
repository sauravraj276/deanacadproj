<table cellpadding="5" hspace="40">
  <tbody>
    <tr>
      <td>
        <table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-top:1px #000000 solid; border-bottom:1px #000000 solid; border-right:1px #000000 solid;border-left:1px #000000 solid;">
          <tbody>
            <tr>
              <?php
              // if cpi variable is not set set it
              if (!isset($_SESSION['cpi'])) {
                $uid_no = $_SESSION['student']['reg_no'];
                //connection module is included
                include './config/config.php';
                $sql = "SELECT `semester`,`cpi`
              FROM `cpi` WHERE reg_no='$uid_no'";
                $result = $conn->query($sql);

                //if no. of rows is zero die;
                if ($result->num_rows > 0) {
                  while (($row = $result->fetch_assoc()) != null) {
                    // convert sem to roman
                    $roman_map = array(1 => "I", 2 => "II", 3 => "III", 4 => "IV", 5 => "V", 6 => "VI", 7 => "VII", 8 => "VIII");
                    // store sem and cpi in session variable
                    $_SESSION['cpi'][$roman_map[$row['semester']]] = $row['cpi'];
                  }

                  echo '
              <td border="1" style="border-top:1px #000000 solid; border-bottom:1px #000000 solid; border-right:1px #000000 solid;border-left:1px #000000 solid;" width="90">
                <center><b>Semester</b></center>
              </td>';
                  foreach ($_SESSION['cpi'] as $sem => $cpi) {
                    echo '<td width="65" border="1" style="border-top:1px #000000 solid; border-bottom:1px #000000 solid; border-right:1px #000000 solid;border-left:1px #000000 solid;">
                <center font-family: "Times New Roman", serif >' . $sem . '</center>
                </td>';
                  }
                  echo '
            </tr>
            <tr>
              <td width="90" border="1" style="border-top:1px #000000 solid; border-bottom:1px #000000 solid; border-right:1px #000000 solid;border-left:1px #000000 solid;">
                <center><b>CPI</b></center>
              </td>';

                  foreach ($_SESSION['cpi'] as $sem => $cpi) {
                    echo '<td  width="65" border="1" style="border-top:1px #000000 solid; border-bottom:1px #000000 solid; border-right:1px #000000 solid;border-left:1px #000000 solid;">
                <center>' . $cpi . '</center>
                </td>';
                  }
                }
              }
              ?>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>