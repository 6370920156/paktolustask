<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
/**plugin name: test plugin
 * 
 */

 function example_form_plugin()
 {
     $content = '';
     $content .= '<h2>Contact Us</h2>';
     $content .= '<form method= "get" action="https://rajwebdev.co.in/testing/">';

     $content .= '<lable for ="first_name">First Name</lable>';
     $content .= ' <span class="error">* <?php echo $nameErr;?></span><input type="text" name="first_name" class="form-control"  placeholder="First name"/>';

     $content .= '<lable for ="milddle_name">Middle Name</lable>';
     $content .= ' <span class="error">* <?php echo $nameErr;?></span><input type="text" name="middle_name" class="form-control" placeholder="Middle name"/>';

     $content .= '<lable for ="last_name">Last Name</lable>';
     $content .= ' <span class="error">* <?php echo $nameErr;?></span><input type="text" name="last_name" class="form-control" placeholder="Last name"/>';

     $content .= '</br><lable for ="your_email">Email</lable>';
     $content .= '<input type="email" name="your_email" class="form-control" placeholder="Enter your Email"/>';

     $content .= '</br><lable for ="your_phone">Phone</lable>';
     $content .= '<input type="text" name="your_phone" class="form-control" placeholder="Enter your Phone"/>';

     $content .= '</br><lable for ="your_address">Address</lable>';
     $content .= '<textarea name="your_address" class="form-control" placeholder="Enter your address"></textarea>';

     $content .= '</br><input type="submit" name="example_form_submit" class="btn btn-md btn-primary" value= "Submit"/>';
     $content .= '</form>';

     return $content;

 }
 add_shortcode( 'example_form', 'example_form_plugin' );
 $nameErr = $emailErr = "";
 $name = $email = "";

 if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (empty($_GET["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_GET["name"]);
    }
    
    if (empty($_GET["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = test_input($_GET["email"]);
    }
}

 function example_form_capture()
 {
 if(isset($_GET['example_form_submit']))
 {
    $name = sanitize_text_field($_GET['first_name']);
    $name = sanitize_text_field($_GET['middle_name']);
    $name = sanitize_text_field($_GET['last_name']);
    $email = sanitize_text_field($_GET['your_email']);
    $phone = sanitize_text_field($_GET['your_phone']);
    $address = sanitize_textarea_field($_GET['your_address']);

    $to = 'rajbarik156@gmail.com';
    $subject = 'test form submission';
    $message = ''.$name.' - '.$email.' - '.$phone.' - '.$address;

    

    wp_mail($to, $subject, $message);
 }
}
add_action('wp_head', 'example_form_capture');
?>

<?php

echo $name;
echo "<br>";
echo $email;
echo "<br>";
?>

</body>
</html>

