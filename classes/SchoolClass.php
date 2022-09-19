<?php
require_once("../PhpConnections/connection.php");

class SchoolClass
{
    function insertClass($className)
    {
        $conn = connect();

        // $created_At = date("Y-m-d H:i:s");
        // $modified_At = date("Y-m-d H:i:s");
        // $Is_Deleted = 0;

        $sql = "INSERT INTO `school_class` (`class_name`) VALUES " . "( :cname )";

        try {
            //code...
            $stmt = $conn->prepare($sql);
        $stmt->bindValue(":cname", $className);
       
       

        $stmt->execute();

        $num_rows = $stmt->rowCount();

     
        //$result = $stmt->fetchAll();
        if ($num_rows  > 0) {
            $msg = "New Class Has Been Created.";
          $msgType = "success";
          ?>
          <div class="alert alert-dismissable alert-<?php echo $msgType; ?>">
              <button data-dismiss="alert" class="close" type="button">x</button>
              <p><?php echo $msg; ?></p>
            </div>
       <?php   
        }else {
            $msg = "Class was not created succesfully" ;
            $msgType = "warning";
            ?>
              <div class="alert alert-dismissable alert-<?php echo $msgType; ?>">
              <button data-dismiss="alert" class="close" type="button">x</button>
              <p><?php echo $msg; ?></p>
            </div>
         <?php   
          }

       
        } catch (Exception $ex) {
            //throw $th;
            echo $ex->getMessage();
        }
        
    }
}
