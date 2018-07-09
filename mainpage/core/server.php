<?php
include("inc/cred.inc.php");
$user_id = $_POST['user_id'];
$word_id = $_POST['word_id'];
$table_id = $_POST['table_id'];
$sql = "SELECT * FROM fav WHERE user_id='".$user_id."' AND word_id='".$word_id."' AND table_id='".$table_id."'";
$result=mysqli_query($conn,$sql) or die (mysqli_error($conn));
$count = mysqli_num_rows($result);
if($table_id=='0'){
  $sql1="SELECT * from trending where id ='".$word_id."'";
  $query1=mysqli_query($conn,$sql1)or die (mysqli_error($conn));
  $row=mysqli_fetch_array($query1);
  $no_of_likes=$row['no_of_likes'];
}
if($table_id=='1'){
  $sql1="SELECT * from dictionary where id ='".$word_id."'";
  $query1=mysqli_query($conn,$sql1)or die (mysqli_error($conn));
  $row=mysqli_fetch_array($query1);
}
if($count>'0'){
  $favrow = mysqli_fetch_array($result);
  $status = $favrow['status'];
  if($status == '0'){
    $sql2 = "UPDATE fav SET status='1' WHERE user_id='".$user_id."' AND word_id='".$word_id."' AND table_id='".$table_id."'";//instead of updating write the code for inserting in trending for chronological order display in favourite
    if ($table_id=='0') {
      $no_of_likes++;
      $sql3 = "UPDATE trending SET no_of_likes='".$no_of_likes."' WHERE id='".$word_id."'";
    }
  }
  if($status == '1'){
    $sql2 = "UPDATE fav SET status='0' WHERE user_id='".$user_id."' AND word_id='".$word_id."' AND table_id='".$table_id."'";
    if ($table_id=='0') {
      $no_of_likes--;
      $sql3 = "UPDATE trending SET no_of_likes='".$no_of_likes."' WHERE id='".$word_id."'";
    }
  }
  $bool = mysqli_query($conn,$sql2)or die (mysqli_error($conn));
  if($table_id=='0'){
      $bool2 = mysqli_query($conn,$sql3)or die (mysqli_error($conn));
  }
}else{
  $sql2 = "INSERT INTO `fav` (`user_id`,`word_id`,`status`,`table_id`) VALUES ('".$user_id."','".$word_id."','1','".$table_id."')";
  if($table_id=='0'){
    $no_of_likes++;
    $sql3 = "UPDATE trending SET no_of_likes='".$no_of_likes."' WHERE id='".$word_id."'";
    $bool2 = mysqli_query($conn,$sql3)or die (mysqli_error($conn));
  }
  $bool = mysqli_query($conn,$sql2)or die (mysqli_error($conn));
}
?>
