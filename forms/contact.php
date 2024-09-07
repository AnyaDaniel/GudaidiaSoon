<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace with your actual receiving email address
  $receiving_email_address = 'anyadaniel1@gmail.com';

  // Check if the PHP Email Form library exists
  if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
  } else {
    die('Unable to load the "PHP Email Form" Library!');
  }

  // Create a new instance of the PHP_Email_Form class
  $contact = new PHP_Email_Form;
  $contact->ajax = true;

  // Set the receiver email
  $contact->to = $receiving_email_address;

  // Retrieve form values from POST request
  if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
    
    // Validate the email format
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      die('Invalid email format.');
    }
    
    $contact->from_name = $_POST['name'];
    $contact->from_email = $_POST['email'];
    $contact->subject = $_POST['subject'];

    // Add the form messages
    $contact->add_message($_POST['name'], 'From');
    $contact->add_message($_POST['email'], 'Email');
    $contact->add_message($_POST['message'], 'Message', 10);

    // Send the email and output the result
    if ($contact->send()) {
      echo 'Your message has been sent. Thank you!';
    } else {
      echo 'Failed to send your message. Please try again later.';
    }
    
  } else {
    die('All form fields are required.');
  }

  // Uncomment the below code if you want to use SMTP to send emails. Provide the correct SMTP credentials.
  /*
  $contact->smtp = array(
    'host' => 'smtp.example.com',
    'username' => 'your_username',
    'password' => 'your_password',
    'port' => '587',
    'encryption' => 'tls' // or 'ssl'
  );
  */
?>
