<?php
require_once("../PhpConnections/connection.php");

class Staff
{
    function insertUser($first_name, $last_name, $phone_No, $address, $staff_role, $myImag, $email, $pass)
    {
        $conn = connect();

        $created_At = date("Y-m-d H:i:s");
        $modified_At = date("Y-m-d H:i:s");
        $Is_Deleted = 0;

        $sql = "INSERT INTO `staff_db` (`First_Name`, `Sur_Name`, `phone_number`, `Address`, `role`, `imageUrl`,`Email`,  `password`) VALUES " . "( :fname, :lname, :pnum, :add, :stf_role, :img_url, :email, :pass )";

        try {
            //code...
            $stmt = $conn->prepare($sql);
        $stmt->bindValue(":fname", $first_name);
        $stmt->bindValue(":lname", $last_name);
        $stmt->bindValue(":pnum", $phone_No);

        $stmt->bindValue(":add", $address);
        $stmt->bindValue(":stf_role", $staff_role);
        $stmt->bindValue(":img_url", $myImag);
        $stmt->bindValue(":email", $email);

        //Password Hashing
        $stmt->bindValue(":pass", $pass);
        //End Password Hashing

        $stmt->execute();

        $num_rows = $stmt->rowCount();
        if ($num_rows  > 0) {
            $msg = "Staff has been registered.";
          $msgType = "success";
          ?>
        <div class="alert alert-<?php echo $msgType; ?> alert-dismissible fade show" role="alert">
                    <?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
       <?php   
        }else {
            $msg = "Staff was not succesfully registered";
            $msgType = "warning";
            ?>
             <div class="alert alert-<?php echo $msgType; ?> alert-dismissible fade show" role="alert">
                    <?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         <?php   
          }

       
        } catch (Exception $ex) {
            //throw $th;
            echo $ex->getMessage();
        }
        
    }
}
