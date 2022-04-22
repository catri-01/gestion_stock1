<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Users.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $users = new Users($db);

  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $post->id = $data->id;

  // Delete Users
  if($post->delete()) {
    echo json_encode(
      array('message' => 'Users Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Users Not Deleted')
    );
  }