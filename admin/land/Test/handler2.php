<?php
require_once("../config.php");

if ($_SERVER['REQUEST_METHOD']==='POST'){
    $First_Name=$_POST['First_Name'];
	$Last_Name=$_POST['Last_Name'];
	$address=$_POST['address'];
	$roll=$_POST['roll'];
	$land_type=$_POST['land_type'];
	$dob=$_POST['dob'];
	$amount=$_POST['amount'];
	$land_owner_contact=$_POST['land_owner_contact'];
	$status=$_POST['status'];
	$details=$_POST['details'];
    $folder = "admin/uploads/";

    //Land Image Upload
    $land_file = $_FILES['land_image']['name'];
    $file = $_FILES['land_type']['tmp_name'];
    $folder = $folder . $land_file;
    $target_file = $folder.basename($land_file);
    $file_name_array = explode(".", $land_file);
    $extension = end($file_name_array);
    $new_land_name = 'Photo_'.rand().'.'.$extension;
    
    //Documents Upload
    $documents_file = $_FILES['documents']['name'];
    $Dfile = $_FILES['documents']['tmp_name'];
    $Dfolder = $Dfolder . $documents_file;
    $Dtarget_file = $folder.basename($documents_file);
    $file_name_array = explode(".", $documents_file);
    $extension = end($file_name_array);
    $Dnew_documents_name = 'documents_'.rand().'.'.$extension;
    if($file!='')
    {
        move_uploaded_file($file, $folder. $new_land_name);
    } 
    if($Nfile!='')
    {
        move_uploaded_file($Dfile, $Dfolder. $Dnew_documents_name);
    }

    $sql="INSERT into land(First_Name,Last_Name,address,roll,land_type,dob,amount,land_owner_contact,status,details,land_image,documents) VALUES(:First_Name,:Last_Name,:address,:roll,:land_type,:dob,:amount,:land_owner_contact,:status,:details,:land_image,:documents)";
    $stmt = $conn->prepare($sql);
  $stmt->bindParam(':First_Name', $First_Name, PDO::PARAM_STR);
  $stmt->bindParam(':Last_Name', $Last_Name, PDO::PARAM_STR);
  $stmt->bindParam(':address', $address, PDO::PARAM_STR);
  $stmt->bindParam(':roll', $roll, PDO::PARAM_STR);
  $stmt->bindParam(':land_type', $land_type, PDO::PARAM_STR);
  $stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
  $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
  $stmt->bindParam(':land_owner_contact', $land_owner_contact, PDO::PARAM_STR);
  $stmt->bindParam(':status', $status, PDO::PARAM_STR);
  $stmt->bindParam(':details', $details, PDO::PARAM_STR);
  $stmt->bindParam(':land_image', $new_land_name, PDO::PARAM_STR);
  $stmt->bindParam(':documents', $Dnew_documents_name, PDO::PARAM_STR);
  $stmt->execute();
  if($stmt->errorInfo()[0] != "00000"){
    echo "Error: " .$stmt->errorInfo()[2];
 }else {
    $last_id = $conn->lastInsertId();

  if($last_id !='')
  {
    header("location:Thank you.php");
  }
  else 
  {
    echo 'Something went wrong';
  }

 }
  



}


    

   
    













    

   
    










