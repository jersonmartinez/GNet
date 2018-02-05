<?php
// define variables and set to empty values
$name = lastname = IDcard = $address = $email = $gender = birth = $nat = phone = phone1 = "";

if ((isset($_POST['submit'])) {
  if (empty($_POST["firstname"])) {
    echo "Firstname is required";
  } else {
    $name = test_input($_POST["firstname"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      echo "Only letters and white space allowed";
    }
  }

  if (empty($_POST['lastname'])) {
    echo "Lastname is required";
  } else {
    $lastname = test_input($_POST["lastname"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
      echo "Only letters and white space allowed";
    }
  }

  if (empty($_POST["address"])) {
    echo "address is required";
  } else {
    $address = test_input($_POST["address"]);
  }

  if (empty($_POST["useremail"])) {
    echo "Email is required";
  } else {
    $email = test_input($_POST["useremail"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Invalid email format"; 
    }
  }

  if (empty($_POST["IDcard"])) {
    echo "ID is required";
  } else {
    $id = test_input($_POST["IDcard"]);
  }

  if (empty($_POST["datepicker"])) {
    echo "date is required";
  } else {
    $birth = test_input($_POST["datepicker"]);
  }

  if (empty($_POST["nationality"])) {
    echo "ID is required";
  } else {
    $nat = test_input($_POST["nationality"]);
  }

  if (empty($_POST["gender"])) {
    echo "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if (empty($_POST["mobile_phone"])) {
    echo "Phone Number is required";
  } else {
    $phone = test_input($_POST["mobile_phone"]);
  }

  if (empty($_POST["home_phone"])) {
    echo = "";
  } else {
    $phone1 = test_input($_POST["home_phone"]);
  }

  $query = "INSERT INTO matricula(name, address, IDcard, birth, nationality, gender, phone, phone1) VALUES('".$name."','".$address."','".$id."','".$birth."','".$nat."','".$gender."','".$phone."','".$phone1."')";
    $create_mat_query = mysqli_query($IC, $query);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>