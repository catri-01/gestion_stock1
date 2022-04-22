<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Users.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $users = new Users($db);

  $data = json_decode(file_get_contents("php://input"));

  $post->prenom = $data->prenom;
  $post->role = $data->role;
  $post->created_at = $data->created_at;
  $post->update_at = $data->update_at;

  // Create Users
  if($post->create()) {
    echo json_encode(
      array('message' => 'Users Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Users Not Created')
    );
  }