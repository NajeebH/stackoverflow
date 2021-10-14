<?php
function insertData($path, $bindings) {
  require_once 'connection.php';

  $myfile = fopen($path, "r") or die("Unable to open file!");

  $sql = fread($myfile,filesize($path));

  fclose($myfile);

   $stmt = $conn->prepare($sql);

  $stmt->bind_param($bindings["BINDING_TYPES"], ...$bindings["VALUES"]);

  $result = $stmt->execute();

  if($result) {
    $data = array("RESULT"=> 1, "LAST_INSERTED_ID" => $conn->insert_id);
  } else {
     $data = array("RESULT"=> 2,  "MESSAGE" => $conn->error);
  }

  $conn->close();

  return $data;
}
