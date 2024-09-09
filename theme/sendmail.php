<!-- <?php
    //we need to get our variables first
    
    $email_to =   'techedmy@gmail.com'; //the address to which the email will be sent
    $name     =   $_POST['name'];  
    $email    =   $_POST['email'];
    $subject  =   $_POST['subject'];
    $message  =   $_POST['message'];
    
    /*the $header variable is for the additional headers in the mail function,
     we are asigning 2 values, first one is FROM and the second one is REPLY-TO.
     That way when we want to reply the email gmail(or yahoo or hotmail...) will know 
     who are we replying to. */
    $headers  = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    if(mail($email_to, $subject, $message, $headers)){
        echo 'sent'; // we are sending this text to the ajax request telling it that the mail is sent..      
    }else{
        echo 'failed';// ... or this one to tell it that it wasn't sent    
    }
?> -->

<?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Define email to which the form data will be sent
        $email_to = 'techedmy@gmail.com'; 
        
        // Retrieve form data
        $name     = $_POST['name'];  
        $email    = $_POST['email'];
        $subject  = $_POST['subject'];
        $message  = $_POST['message'];
        
        // Debugging: Log or display the form data
        echo "<p>Form Data:</p>";
        echo "<p>Name: $name</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Subject: $subject</p>";
        echo "<p>Message: $message</p>";

        // Create email headers
        $headers  = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Try to send email and check for success/failure
        if (mail($email_to, $subject, $message, $headers)) {
            echo 'Email sent successfully.';
        } else {
            echo 'Failed to send email.';
        }
    } else {
        echo 'Form not submitted.';
    }
?>
