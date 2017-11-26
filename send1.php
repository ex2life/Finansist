﻿<?php
// несколько получателей
$to = 'abramizsaransk@gmail.com'; // обратите внимание на запятую

$subject = 'Website Change Request';

$headers = "From: " . strip_tags($_POST['req-email']) . "\r\n";
$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
$headers .= "CC: susan@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8";


// текст письма
$message = "
<html lang='ru'>
<head>
<title>Подтверждение регистрации</title>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width'>
<style type='text/css'>
    /* CLIENT-SPECIFIC STYLES */
    #outlook a{padding:0;} /* Force Outlook to provide a 'view in browser' message */
    .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
    body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
    table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
    img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

    /* RESET STYLES */
    body{margin:0; padding:0;}
    img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
    table{border-collapse:collapse !important;}
    body{height:100% !important; margin:0; padding:0; width:100% !important;}

    /* iOS BLUE LINKS */
    .appleBody a {color:#68440a; text-decoration: none;}
    .appleFooter a {color:#999999; text-decoration: none;}

    /* MOBILE STYLES */
    @media screen and (max-width: 525px) {

        /* ALLOWS FOR FLUID TABLES */
        table[class='wrapper']{
          width:100% !important;
        }

        /* ADJUSTS LAYOUT OF LOGO IMAGE */
        td[class='logo']{
          text-align: left;
          padding: 20px 0 20px 0 !important;
        }

        td[class='logo'] img{
          margin:0 auto!important;
        }

        /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
        td[class='mobile-hide']{
          display:none;}

        img[class='mobile-hide']{
          display: none !important;
        }

        img[class='img-max']{
          max-width: 100% !important;
          height:auto !important;
        }

        /* FULL-WIDTH TABLES */
        table[class='responsive-table']{
          width:100%!important;
        }

        /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
        td[class='padding']{
          padding: 10px 5% 15px 5% !important;
        }

        td[class='padding-copy']{
          padding: 10px 5% 10px 5% !important;
          text-align: center;
        }

        td[class='padding-meta']{
          padding: 30px 5% 0px 5% !important;
          text-align: center;
        }

        td[class='no-pad']{
          padding: 0 0 20px 0 !important;
        }

        td[class='no-padding']{
          padding: 0 !important;
        }

        td[class='section-padding']{
          padding: 50px 15px 50px 15px !important;
        }

        td[class='section-padding-bottom-image']{
          padding: 50px 15px 0 15px !important;
        }

        /* ADJUST BUTTONS ON MOBILE */
        td[class='mobile-wrapper']{
            padding: 10px 5% 15px 5% !important;
        }

        table[class='mobile-button-container']{
            margin:0 auto;
            width:100% !important;
        }

        a[class='mobile-button']{
            width:80% !important;
            padding: 15px !important;
            border: 0 !important;
            font-size: 16px !important;
        }

    }
</style>
</head>
<body style='margin: 0; padding: 0;'>

<!-- HEADER -->
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
        <td bgcolor='#ffffff'>
            <div align='center' style='padding: 0px 15px 0px 15px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='500' class='wrapper'>
                    <!-- LOGO/PREHEADER TEXT -->
                    <tr>
                        <td style='padding: 20px 0px 30px 0px;' class='logo'>
                            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                <tr> 
								    <!-- —сылку на сайт нужно добавить -->
                                    <td bgcolor='#ffffff' width='100' align='left'><a href='' target='_blank'><img alt='Logo' src='http://i98.fastpic.ru/big/2017/1126/86/624b3fe911d46715631e93c8a29ac686.png' width='213' height='43' style='display: block; font-family: Helvetica, Arial, sans-serif; color: #666666; font-size: 16px;' border='0'></a></td>
                                    <td bgcolor='#ffffff' width='400' align='right' class='mobile-hide'>
                                        <table border='0' cellpadding='0' cellspacing='0'>
                                            <tr>
                                                <td align='right' style='padding: 0 0 5px 0; font-size: 14px; font-family: Arial, sans-serif; color: #666666; text-decoration: none;'><span style='color: #666666; text-decoration: none;'>Фининсист - это то, что нужно.<br>Ваш помощник в финансах.</span></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
</table>

<!-- ONE COLUMN SECTION -->
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
        <td bgcolor='#ffffff' align='center' style='padding: 70px 15px 20px 15px;' class='section-padding'>
            <table border='0' cellpadding='0' cellspacing='0' width='500' class='responsive-table'>
                <tr>
                    <td>
                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                        <tr>
                                            <td align='center' style='font-size: 40px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding-copy'>Cпасибо за регистрацию на сайте, username!</td>
                                        </tr>
										<tr>
                                            <td align='center' style='font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding-copy'>Осталось подтвердить вашу учетную запись.</td>
                                        </tr>
                                        <tr>
                                            <td align='center' style='padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'>Просто нажмите на кнопку, чтобы мы были уверены в правильности указанной почты.</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- BULLETPROOF BUTTON -->
                                    <table width='100%' border='0' cellspacing='0' cellpadding='0' class='mobile-button-container'>
                                        <tr>
                                            <td align='center' style='padding: 25px 0 0 0;' class='padding-copy'>
                                                <table border='0' cellspacing='0' cellpadding='0' class='responsive-table'>
                                                    <tr>
                                                        <td align='center'><a href='adres_postver' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #5D9CEC; border-top: 15px solid #5D9CEC; border-bottom: 15px solid #5D9CEC; border-left: 25px solid #5D9CEC; border-right: 25px solid #5D9CEC; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;' class='mobile-button'>Подтвердить &rarr;</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- Проблемы регистрации -->
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
        <td bgcolor='#f8f8f8' align='center' style='padding: 20px 15px 20px 15px;' class='section-padding-bottom-image'>
            <table border='0' cellpadding='0' cellspacing='0' width='500' class='responsive-table'>
                <tr>
                    <td>
                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                            <tr>
                                <td align='center' style='padding: 0 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'>Если не получается, перейдите по этой ссылке или скопируйте и вставьте её в браузер</td>
                            </tr>
							<tr>
								<td valign='top'>
								  <table width='585' align='left' cellpadding='0' cellspacing='0' border='0' bgcolor='transparent' style='table-layout:fixed'>
									<tbody><tr>
									  <td valign='top' style='font-size:0;line-height:0' width='17' bgcolor='transparent'>
										<div style='overflow:hidden;font-size:0;line-height:0;background-color:transparent;width:17px'><font size='0' style='font-size:0px;line-height:0px;display:block;background-color:transparent'><span style='font-size:0px;line-height:0px;display:block;background-color:transparent'></span></font></div>
									  </td>
									  <td valign='top'><img src='http://i98.fastpic.ru/big/2017/1126/d4/46ebc0ceafba20e566b13fda469441d4.png' width='27' height='27' align='left' class='CToWUd'>
									  </td>
									  <td valign='top' width='537' style='word-wrap:break-word;word-break:break-all;word-break:break-word'><a href='finansist/dfsfdsdf/dsfdsfs/dgfsdbfdwrgsfdb/xvsdsdf' style='text-decoration:none' target='_blank' ><span style='font-family:Tahoma,Arial,Helvetica,FreeSans,sans-serif;font-size:16px;line-height:20px;font-weight:normal;color:#00a5ff;text-decoration:underline'>finansist/dfsfdsdf/dsfdsfs/dgfsdbfdwrgsfdb/xvsdsdffs/dgfsdbfdwrgsfdb/xvsdsdffs/dgfsdbfdwrgsfdb/xvsdsdffs/dgfsdbfdwrgsfdb/xvsdsdffs/dgfsdbfdwrgsfdb/xvsdsdffs/dgfsdbfdwrgsfdb/xvsdsdf</span></a>
									  </td>
									</tr>
								  </tbody></table>
								</td>
							</tr>
							 <tr>
                                <td align='center' style='padding: 0 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'>Если вы не понимаете, что происходит, проигнорируйте это письмо</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>


<!-- FOOTER -->
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
        <td bgcolor='#ffffff' align='center'>
            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
                <tr>
                    <td style='padding: 20px 0px 20px 0px;'>
                        <!-- UNSUBSCRIBE COPY -->
                        <table width='500' border='0' cellspacing='0' cellpadding='0' align='center' class='responsive-table'>
                            <tr>
                                <td align='center' style='padding: 0 0 0 0; font-size: 14px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'>По всем вопросам пишите на <a href='mailto:finansistslepakov@yandex.ru'>finansistslepakov@yandex.ru</a><br></td>
                            </tr>  
							<tr>
							<td align='center' valign='middle' style='font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
                                    <span class='appleFooter' style='color:#666666;'>Вы получили это письмо, поскольку при регистрации на сайте Finansist был указан адрес email</span>
                                </td>
                            </tr><tr>
							<td align='center' valign='middle' style='font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
                                    <span class='appleFooter' style='color:#666666;'>2017 Finansist</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
";




// Отправляем
mail($to, $subject, $message,$headers);
?>