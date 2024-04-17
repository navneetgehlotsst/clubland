<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width">
      <title></title>
      <style></style>
   </head>
   <body style="background-color:#faf5ff">
      <div id="email" style="width:600px;margin: auto;background:white;">
        <!-- Header -->
        <table role="presentation" border="0" width="100%" cellspacing="0">
            <tr>
               <td bgcolor="#fff" align="center" style="color: white;">
                  <img alt="Flower"
                     src="https://clublandservices.com/web/images/customcolor_logo.png"
                     width="200px">
            </tr>
            </td>
         </table>        
        <!-- Header -->
         <table role="presentation" border="0" width="100%" cellspacing="0" style="margin-top: 20px;">
            <tr>
               <td bgcolor="#1e532e" align="center" style="color: white; height: 100px; padding: 20px 0px;">
               <h2 style="font-size: 28px; margin:0 0 20px 0; font-family:poppins;"> Email verification link</h2>
            </tr>
            </td>
         </table>
         <!-- Body 1 -->
         <table role="presentation" border="0" width="100%" cellspacing="0">
            <tr>
               <td style="padding: 30px 30px 30px 60px;">
               <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:poppins"><strong> Hello {{$data['user_name']}}</strong></p>
                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:poppins">Please verify your email with below link</p>
                  <p style="margin:0;font-size:16px;line-height:24px;font-family:poppins; text-align: center; padding-top: 30px;">
                    <a href="{{ route('user.verify',$data['token']) }}" style="display:inline-block;background:#1e532e;color:#fff;font-family:poppins;font-size:16px;font-weight:400;line-height:1;letter-spacing:1px;margin:0;text-decoration:none;text-transform:none;padding:12px 24px 12px 24px;border-radius:4px">
                        Verify my email address</a></p>

                        <p>For further information on how to complete your profile, please visit on the link below</p>
                        <p><a href="https://www.youtube.com/watch?v=wt5-Mcimw78" target="_blank">How To Set Up Your Clubland Services Profile</a></p>

               </td>
            </tr>
         </table>
         <!-- Body 3-->
         <table role="presentation" border="0" width="100%" cellspacing="0" style="margin-top: 20px;">
            <tr>
               <td bgcolor="#1e532e" align="center" style="color: white; height: 1px;">
            </tr>
            </td>
         </table>
         <!-- Body 2-->
         <table role="presentation" align="center" border="0" width="200px" cellspacing="0" style="padding-top: 20px;">
            <tr style="text-align: center;">
               <td style="vertical-align: top;">
                  <a href="https://www.facebook.com/clublandservices" target="_blank">
                    <img alt="Facebook"
                src="https://cdn-icons-png.flaticon.com/512/15047/15047435.png"
                width="35px" style="border-radius: 50px;">
                  </a>
               </td>
               <td style="vertical-align: top;">
                  <a href="https://twitter.com/clublandservice" target="_blank">
                    <img alt="X"
                src="https://cdn-icons-png.flaticon.com/512/5969/5969020.png"
                width="35px" style="border-radius: 50px;">
                  </a>
               </td>
               <td style="vertical-align: top;">
                  <a href="https://www.youtube.com/@ClublandServices" target="_blank">
                    <img alt="youtube"
                src="https://cdn-icons-png.flaticon.com/512/3670/3670209.png"
                width="35px" style="border-radius: 50px;">
                  </a>
               </td>
               <td style="vertical-align: top;">
                  <a href="https://www.instagram.com/clubland_services/" target="_blank">
                    <img alt="instagram"
                src="https://cdn-icons-png.flaticon.com/512/4138/4138124.png"
                width="35px" style="border-radius: 50px;">
                  </a>
               </td>
            </tr>
         </table>
         <!-- Body 3 -->
         <table role="presentation" border="0" width="100%">
            <tr>
               <td align="center" style="padding: 30px 30px;">
                <p style="text-align:center; font-family: poppins; font-size: 14px; font-weight: 400;"><strong>| <a href="https://clublandservices.com/page/privacy_policy" target="_blank">Privacy
                    Policy</a> | <a href="https://clublandservices.com/business/contact-us" target="_blank"> Contact Details </a> |
                    &nbsp;&nbsp;</strong></p>
               </td>
            </tr>
         </table>
         <!-- Footer -->
      </div>
   </body>