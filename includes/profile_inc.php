<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/user.php';

// Instantiate user
$profileUser = new User($db);

// Find user ID with the username from the URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $profileUser->setId($id);
} else {
  header("Location: $redirect_page?errorcode=4");
  exit();
}
// Read the details of user to be read
if(!$profileUser->readOne()){
  // If you dont find one you get redirected
  header("Location: $redirect_page?errorcode=4");
  exit();
}

// Get user values from database
$User_ID = $profileUser->getId();
$firstname = $profileUser->getFirstname();
$lastname = $profileUser->getLastname();
$username = $profileUser->getUsername();
$email = $profileUser->getEmail();

$image = $profileUser->getFullImagePath();

// Controls toggle of $edit
$edit = false;
if (isset($_POST['edit']) ) {
  $edit = true;
}

// Disconnects the image from the user in the database
function deleteImage(User $profileUser){
  $profileUser->setImage(null);
  $profileUser->update();
  header("Location: ?id=". $profileUser->getId());
  exit();
}

function updateUser($db, $profileUser) {

  $edit = false;
    // Checks if the username has been changed by the user and if the username
    // Fits the criteria for a valid username. If not it displays a warning
    if (isset($_POST['username']) && !empty($_POST['username'])) {
      if ($profileUser->getUsername() != $_POST['username']) {
        // Calls isUsernameValid function. This throws an Exception when the username for some reason isn't valid.
        User::isUsernameValid($db, $_POST['username']);
        $profileUser->setUsername($_POST['username']);
      }
    }
    else if (empty($_POST['username'])) {
      throw new Exception('Die Änderungen konnten nicht übernommen werden. Der Benutzername darf nicht leer sein.');
    }
    if (isset($_POST['firstname']) ) {
      $profileUser->setFirstname($_POST['firstname']);
    }
    if (isset($_POST['lastname']) ) {
      $profileUser->setLastname($_POST['lastname']);
    }
    if (isset($_POST['email']) ) {
      User::isEmailValid($db, $_POST['email']);
      $profileUser->setEmail($_POST['email']);
    }

    // Update the user with the set attributes
    if($profileUser->update()){
        header("Location: ?id=". $profileUser->getId());
        exit();
    }

    header("Location: /Kegeln/index.php?message=1");
    exit();
}

// Will upload image file to server
function uploadImage($image){

  // If image is not empty, try to upload the image
  if($image){
    $target_directory = "../uploads/";
    $target_file = $target_directory . $image;
    $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

    // Make sure that file is a real image
    $check = exif_imagetype($_FILES["image"]["tmp_name"]);
    if($check!==false){
        // Submitted file is an image
    } else {
        throw new Exception("Die hochgeladene Datei ist kein Bild!");
    }
    // Make sure certain file types are allowed
    $allowed_file_types=array("jpg", "jpeg", "png", "gif");
    if(!in_array($file_type, $allowed_file_types)){
        throw new Exception("Es sind nur die Dateitypen JPG, JPEG, PNG und GIF erlaubt");
    }

    // Make sure file does not exist
    if(file_exists($target_file)){
        throw new Exception("Es gibt schon ein Bild mit diesem Namen. Bitte nenne das Bild um.");
    }

    // Make sure the 'uploads' folder exists
    // If not, create it
    if(!is_dir($target_directory)){
        mkdir($target_directory, 0777, true);
    }

    // It means there are no errors, so try to upload the file
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
      // It means image was uploaded
    } else {
      throw new Exception("Das Bild konnte nicht hochgeladen werden.");
    }
    return true;
  }
}
?>
