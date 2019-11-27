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

// Controls toggle of $edit
$edit = false;
if (isset($_POST['edit']) ) {
  $edit = true;
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
?>
