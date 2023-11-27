<?php
include("functions.php");

if ($_SERVER['HTTP_HOST'] == 'localhost') {
  $assets_url = '../uploads/';
} else {
  $assets_url = '../images/uploads/';
}

if (isset($_GET['d_e_status'])) {
  $lead_no = $_GET['design_status_id'];
  $attachment_files = get_design_files($lead_no);
  $user_details = get_sql_single_data("c_name,c_email", "project_enquiries", "application_no='$lead_no'");
  $design_file = $assets_url . $attachment_files[0][0];
  $estimation_file = $assets_url . $attachment_files[0][1];
?>

  <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

  <head>
    <!--[if gte mso 9]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<![endif]-->
    <title></title>

    <?php
    require("PHPMailer/src/Exception.php");
    require("PHPMailer/src/PHPMailer.php");
    require("PHPMailer/src/SMTP.php");

    //   use PHPMailer\PHPMailer\PHPMailer;
    //   use PHPMailer\PHPMailer\Exception;

    //   require 'PHPMailer/src/Exception.php';
    //   require 'PHPMailer/src/PHPMailer.php';
    //   require 'PHPMailer/src/SMTP.php';

    //PHPMailer Object
    $mail = new PHPMailer\PHPMailer\PHPMailer(); //Argument true in constructor enables exceptions

    //Tell PHPMailer to use SMTP
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "werneartech@gmail.com";
    $mail->Password   = "duxjhepcfmafmpyq";

    $mail->IsHTML(true);
    $mail->AddAddress($user_details[0][1], "SSARCHINDIA");
    $mail->SetFrom("werneartech@gmail.com", "SSARCHINDIA");
    $mail->AddReplyTo("werneartech@gmail.com", "SSARCHINDIA");
    // $mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
    $mail->Subject = 'Designs and Estimations for application no ' . $lead_no;

    $content = "

    <style type='text/css'>
      table, td { color: #000000; } @media only screen and (min-width: 620px) {
  .u-row {
    width: 600px !important;
  }
  .u-row .u-col {
    vertical-align: top;
  }

  .u-row .u-col-33p33 {
    width: 199.98px !important;
  }

  .u-row .u-col-50 {
    width: 300px !important;
  }

  .u-row .u-col-66p67 {
    width: 400.02px !important;
  }

  .u-row .u-col-100 {
    width: 600px !important;
  }

}

@media (max-width: 620px) {
  .u-row-container {
    max-width: 100% !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
  .u-row .u-col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important;
  }
  .u-row {
    width: calc(100% - 40px) !important;
  }
  .u-col {
    width: 100% !important;
  }
  .u-col > div {
    margin: 0 auto;
  }
}
body {
  margin: 0;
  padding: 0;
}

table,
tr,
td {
  vertical-align: top;
  border-collapse: collapse;
}

p {
  margin: 0;
}

.ie-container table,
.mso-container table {
  table-layout: fixed;
}

* {
  line-height: inherit;
}

a[x-apple-data-detectors='true'] {
  color: inherit !important;
  text-decoration: none !important;
}

</style>
</head>

<body class='clean-body' style='margin: 0;padding: 0px 10px 0px 10px;-webkit-text-size-adjust: 100%;background-color: #fff;color: #000000'>
<!--[if IE]><div class='ie-container'><![endif]-->
<!--[if mso]><div class='mso-container'><![endif]-->
<table style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #fff;width:100%' cellpadding='0' cellspacing='0'>
<tbody>
<tr style='vertical-align: top'>
  <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
<div class='u-row-container' style='padding: 15px 5px 0px;background-color: rgba(255,255,255,0)'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #178CC2;'>
  <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
<div class='u-col u-col-33p33' style='max-width: 320px;min-width: 200px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:20px;font-family:'Lato',sans-serif;' align='center'>
    <div style='color: #ffffff; line-height: 120%; text-align: center; word-wrap: break-word;'>
    <img align='center' border='0' src='http://ssarchindia.com/wp-content/uploads/2020/05/logos-300x98.jpg' alt='Image' title='Image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;margin-top:20px;float: none;width: 100%;max-width: 120px;border-radius:0px 20px 0px 20px;' width='120'/>
     <p style='font-size: 14px; line-height: 120%; text-align: center;'><span style='font-size: calc(1.5em + 0.5vw); line-height: 80px; font-weight:bolder; font-family:arial;'>Designs and Estimations</span></p>
   </div>  
    </td>
  </tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
<!--[if (mso)|(IE)]><td align='center' width='400' style='width: 400px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-66p67' style='max-width: 320px;min-width: 400px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>
</div>



<div class='u-row-container' style='padding: 0px 10px;background-color: rgba(255,255,255,0)'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f5f5f5;'>
  <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px 10px;background-color: rgba(255,255,255,0);' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #f5f5f5;'><![endif]-->
    
<!--[if (mso)|(IE)]><td align='center' width='300' style='width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Lato',sans-serif;' align='left'>
      
<h1 style='margin: 0px; padding-left:15px; color: #FF0055; line-height: 100%; text-align: left; word-wrap: break-word; font-weight: bold; font-family: arial,helvetica,sans-serif; font-size: 17px;font-style: italic; margin-top:20px;'>";
    $content .= "Good ";
    $content .= (date('H') > 17) ? "Evening" : ((date('H') > 12) ? "Afternoon" : "Morning");
    $content .= " " . $user_details[0][0] . ",<p>Wellness Greetings!!</p>";
    $content .= "</h1>

    </td>
  </tr>
</tbody>
</table>

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:10px 20px 30px;font-family:'Lato',sans-serif;' align='left'>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
<!--[if (mso)|(IE)]><td align='center' width='300' style='width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>
</div>



<div class='u-row-container' style='padding: 0px 10px;background-color: rgba(255,255,255,0)'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;word-break: break-word;background-color: #f5f5f5;'>
  <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;word-wrap: break-word;'>
    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px 10px;background-color: rgba(255,255,255,0);' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #f5f5f5;'><![endif]-->
    
<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;word-wrap: break-word;'>
<div style='width: 100% !important;word-wrap: break-word;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='word-break:break-word;padding:10px;font-family:'Lato',sans-serif;' align='left'>
      
<div style='line-height: 140%; text-align: left;padding-left:15px;word-wrap: break-word;'>
  <p style='font-size: 14px; line-height: 140%;'>
  Thank you for your interest in our solutions at SSARCHINDIA PVT LTD.<br>
  <br>
  Kindly find the attached designs and estimations based on the project enquiry placed by you.<br>
  Go through the files and let us know further your views on the same.<br>
  Waiting for your response.
  </p>
</div>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>
</div>



<div class='u-row-container' style='padding: 0px 10px;background-color: rgba(255,255,255,0)'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;'>
  <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px 10px;background-color: rgba(255,255,255,0);' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #ffffff;'><![endif]-->
    
<!--[if (mso)|(IE)]><td align='center' width='300' style='width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;padding-left:15px;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
<!--[if (mso)|(IE)]><td align='center' width='300' style='width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 1px solid #eee;'><!--<![endif]-->

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>
</div>";

    $content .= "
<div class='u-row-container' style='padding-left:10px;background-color: rgba(255,255,255,0)'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;'>
  <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px 10px;background-color: rgba(255,255,255,0);' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #ffffff;'><![endif]-->
    
<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:'Lato',sans-serif;' align='left'>
      
<table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #e3e3e3;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
  <tbody>
    <tr style='vertical-align: top'>
      <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
        <span>&#160;</span>
      </td>
    </tr>
  </tbody>
</table>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>
</div>



<div class='u-row-container' style='padding: 0px 10px 20px;background-color: rgba(255,255,255,0)'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #178CC2;'>
  <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px 10px 20px;background-color: rgba(255,255,255,0);' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #17c297;'><![endif]-->
    
<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:30px 20px;font-family:'Lato',sans-serif;' align='left'>
      
    <div style='color: #FFFFFF; line-height: 100%; text-align: left; word-wrap: break-word;padding-left:15px;'>
    <p style='font-size: 14px; line-height: 90%;'>Thanks & Regards,</p>
    <p style='font-size: 14px; line-height: 60%;'>SSARCH.PVT.LTD</p>
    <p style='font-size: 14px; line-height: 60%;'>Mahape, Navi Mumbai,</p>
    <p style='font-size: 14px; line-height: 60%;'>Maharashtra 421204. </p>
</div>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>
</div>


  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  </td>
</tr>
</tbody>
</table>
<!--[if mso]></div><![endif]-->
<!--[if IE]></div><![endif]-->
";
    $mail->MsgHTML($content);
    $mail->addAttachment($design_file);
    $mail->addAttachment($estimation_file);
    if (!$mail->Send()) {
      echo 'Mailer error: ' . $mail->ErrorInfo;
      echo "<script>alert('Error! Try Again');</script>";
      echo "<script>window.open('index.php?lead_flow=$lead_no','_self')</script>";
    } else {
      require("includes/db.php");
      $sql = "UPDATE designs_estimations SET d_e_status='approved',d_e_updated_at=NOW() WHERE lead_no='$lead_no';";
      $sql .= "UPDATE leads SET lead_status='design_approved',lead_updated_at=NOW() WHERE lead_no='$lead_no'";
      if ($con->multi_query($sql)) {
        echo "<script>alert('Designs approved & Mail Sent Successfully');</script>";
        echo "<script>window.open('index.php?lead_flow=$lead_no','_self')</script>";
      }
    }
    ?>
    </body>

  </html>
<?php } ?>