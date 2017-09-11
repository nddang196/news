<?php
function sendMail($title, $content, $nTo, $mTo,$cc=''){
    $nFrom = 'noname.net';
    $mFrom = 'congiovothanh@gmail.com';  //dia chi email cua ban
    $mPass = 'dang1996';       //mat khau email cua ban
    $mail             = new PHPMailer();
    $body             = $content;
    $mail->IsSMTP();
    $mail->CharSet   = "utf-8";
    //$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;                    // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";
    $mail->Port       = 465;
    $mail->Username   = $mFrom;  // GMAIL username
    $mail->Password   = $mPass;               // GMAIL password
    $mail->SetFrom($mFrom, $nFrom);
    //chuyen chuoi thanh mang
    $ccmail = explode(',', $cc);
    $ccmail = array_filter($ccmail);
    if(!empty($ccmail)){
        foreach ($ccmail as $k => $v) {
            $mail->AddCC($v);
        }
    }
    $mail->Subject    = $title;
    $mail->MsgHTML($body);
    $address = $mTo;
    $mail->AddAddress($address, $nTo);
    $mail->AddReplyTo($mFrom);
    if(!$mail->Send()) {
        return $mail->ErrorInfo;
    } else {
        return 1;
    }
}

function sendMailAttachment($title, $content, $nTo, $mTo,$cc='',$file,$filename){
    $nFrom = 'noname.net';
    $mFrom = 'congiovothanh@gmail.com';  //dia chi email cua ban
    $mPass = 'dang1996';       //mat khau email cua ban
    $mail             = new PHPMailer();
    $body             = $content;
    $mail->IsSMTP();
    $mail->CharSet    = "utf-8";
    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;                    // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";
    $mail->Port       = 465;
    $mail->Username   = $mFrom;  // GMAIL username
    $mail->Password   = $mPass;               // GMAIL password
    $mail->SetFrom($mFrom, $nFrom);
    //chuyen chuoi thanh mang
    $ccmail = explode(',', $cc);
    $ccmail = array_filter($ccmail);
    if(!empty($ccmail)){
        foreach ($ccmail as $k => $v) {
            $mail->AddCC($v);
        }
    }
    $mail->Subject    = $title;
    $mail->MsgHTML($body);
    $address = $mTo;
    $mail->AddAddress($address, $nTo);
    $mail->AddReplyTo($mFrom);
    $mail->AddAttachment($file,$filename);
    if(!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }
}