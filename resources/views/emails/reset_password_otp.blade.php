Hello {{$user->fullname}},
<br>
<br>
We have received a password reset request for your account. 
<br>
<br>
Use below OTP to verify your request in mobile app. This OTP is valid for 60 minutes.
<br>
<h1 style="font-size:40px">{{$user->reset_password_otp}}</h1>
<br>
If you did not request a password reset, please ignore this email.
<br>