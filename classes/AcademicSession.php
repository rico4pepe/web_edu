<?php
require_once("../PhpConnections/connection.php");

Class AcademicSession{

    //private $all_user = [];

    // private $Day;
    // private $Hour;
    
    // private $Subjects;

    // private $conn;


   function facilitators(){

       $conn = connect();
    $user_query  = $conn->prepare("SELECT * FROM staff_db");
    $user_query->execute();
   
        while($row = $user_query->fetch(PDO::FETCH_ASSOC)){
                 $users = $row['First_Name'] . " " . $row['Sur_Name'];
                 $userId = $row['staff_ID'];

                 echo '<option value=" '.$userId.'" >'.$users.'</option>';
        }
    }

    function dropDown_academicYear(){

        $conn = connect();
     $user_query  = $conn->prepare("SELECT * FROM session_table");
     $user_query->execute();
    
         while($row = $user_query->fetch(PDO::FETCH_ASSOC)){
                  $academic_year = $row['Session_year'] ;
                  $academic_yearId = $row['id'] ;
             
 
                  echo '<option value=" '. $academic_yearId.'" >'.$academic_year.'</option>';
         }
     }


     function dropDown_academicTerm(){

        $conn = connect();
     $user_query  = $conn->prepare("SELECT * FROM school_term");
     $user_query->execute();
    
         while($row = $user_query->fetch(PDO::FETCH_ASSOC)){
                  $academic_term = $row['term_name'] ;
                  $academic_termId = $row['term_id'] ;
             
 
                  echo '<option value=" '. $academic_termId.'" >'.$academic_term.'</option>';
         }
     }


     function activateSessionTerm($academic_year, $term)
    {
        $conn = connect();

        $academic_query  = $conn->query("SELECT COUNT(id) AS total FROM `academic_session`");
        $academic_row = $academic_query->fetch((PDO::FETCH_ASSOC));
        $academic_count  = $academic_row['total'];

        //$sql = "INSERT INTO `academic_session` (`session_id`, `term_id`) VALUES " . "( :sessname, :tname )";

        try {
            //code...

           

            if($academic_count == 0){
                $sql = "INSERT INTO `academic_session` (`session_id`, `term_id`) VALUES " . "( :sessname, :tname )";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(":sessname", $academic_year);
                $stmt->bindValue(":tname", $term);
                $stmt->execute();

                $num_rows = $stmt->rowCount();
                
        //$result = $stmt->fetchAll();
        if ($num_rows  > 0) {
            $msg = "Current Session and Term Has Been Created For the First Time.";
          $msgType = "success";
          ?>
          <div class="alert alert-<?php echo $msgType; ?> alert-dismissible fade show" role="alert">
                    <?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
       <?php   
        }else {
            $msg = "Unable to activate Current Session and Term" ;
            $msgType = "warning";
            ?>
              <div class="alert alert-<?php echo $msgType; ?> alert-dismissible fade show" role="alert">
                    <?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         <?php   
          }
               
            }else{
                $academic_query  = $conn->query("SELECT id AS academicId FROM `academic_session`");
                $academic_row = $academic_query->fetch((PDO::FETCH_ASSOC));
                $academic_id  = $academic_row['academicId'];

                $stmt = $conn->prepare("UPDATE academic_session SET session_id=:as, term_id=:ua WHERE id=:id");
                $stmt->bindParam(":as", $academic_year);
                $stmt->bindParam(":ua", $term);
                $stmt->bindParam(":id", $academic_id );

                $num_rows = $stmt->rowCount();

                if ($num_rows  > 0) {
                    $msg = "Current Session and Term Has Been Updated and Activated.";
                  $msgType = "success";
                  ?>
                  <div class="alert alert-<?php echo $msgType; ?> alert-dismissible fade show" role="alert">
                    <?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
               <?php   
                }else {
                    $msg = "Unable to Update and  activate Current Session and Term " ;
                    $msgType = "warning";
                    ?>
                      <div class="alert alert-<?php echo $msgType; ?> alert-dismissible fade show" role="alert">
                    <?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                 <?php   
                  }


            }

       
        } catch (Exception $ex) {
            //throw $th;
            echo $ex->getMessage();
        }
        
    }
 

    

    

    


// function Dailys(){
//     $conn = connect();
//     $Daily_query  = $conn->prepare("SELECT * FROM `Days_DB`");
//     $Daily_query->execute();
//     while($row = $Daily_query->fetch(PDO::FETCH_ASSOC)){
//       $Dailys = $row['Name'] ;
//       $DailysId = $row['ID'];
      
//       echo '<option value=" '.$DailysId.'" >'.$Dailys.'</option>';

//     }
// }

//     function Customers(){

//         $conn = connect();
//         $user_query1  = $conn->query("SELECT COUNT(*) as all_customer FROM users WHERE is_permission = '4'");
//         $user_row1 = $user_query1->fetch((PDO::FETCH_ASSOC));
//         $this->all_customer  = $user_row1['all_customer'];

//         return $this->all_customer;

//      }

//      function Category(){

//         $conn = connect();
//         $user_query2  = $conn->query("SELECT COUNT(*) as all_category FROM `Categorys`");
//         $user_row2 = $user_query2->fetch((PDO::FETCH_ASSOC));
//         $this->category  = $user_row2['all_category'];
//         return $this->category;

//      }

//      function Product(){

//       $conn = connect();
//       $user_query2  = $conn->query("SELECT COUNT(*) as all_product FROM `Products`");
//       $user_row2 = $user_query2->fetch((PDO::FETCH_ASSOC));
//       $this->products  = $user_row2['all_product'];
//       return $this->products;

//    }

//    function Transaction(){

//       $conn = connect();
//       $user_query2  = $conn->query("SELECT COUNT(*) as all_transaction FROM `transactions`");
//       $user_row2 = $user_query2->fetch((PDO::FETCH_ASSOC));
//       $this->transaction  = $user_row2['all_transaction'];
//       return $this->transaction;

//    }

//    function Elearning(){
//       $conn = connect();
//       $user_query2  = $conn->query("SELECT COUNT(*) as all_learn FROM `elearnings`");
//       $user_row2 = $user_query2->fetch((PDO::FETCH_ASSOC));
//       $this->learning  = $user_row2['all_learn'];

//       return $this->learning;

//    }
   
//     function Permission($user_role){

//       $conn = connect();
//       $user_query2  = $conn->query("SELECT * FROM `user_permission` where user_role = $user_role");
//       $user_row2 = $user_query2->fetch((PDO::FETCH_ASSOC));
//       $this->create  = array("create" =>$user_row2['generate']);
//       $this->edit  = array ("edit" => $user_row2['edit']);
//       $this->read  =  array ("view" => $user_row2['view']);
//       $this->delete  =  array ("delete" => $user_row2['remove']);
//       array_push($this->rolesArray, $this->create, $this->edit, $this->read, $this->delete);
      
//       return $this->rolesArray; 

//    }

}
