<!DOCTYPE html>
<html lang="en">

<head>
	<title>Coming Soon</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="{{asset('/landing/images/icons/customcolor_icon_transparent_background.png')}}" />

	<link rel="stylesheet" type="text/css" href="{{asset('/landing/vendor/bootstrap/css/bootstrap.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('/landing/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/landing/css/main.css')}}">

	<meta name="robots" content="noindex, follow">
</head>

<body>
	<div class="bg-img1 size1 flex-w flex-c-m p-t-55 p-b-55 p-l-15 p-r-15"
		style="background:linear-gradient(90deg, rgba(28,149,89,1) 100%, rgba(27,132,80,0) 100%)">
		<div class="wsize1 bor1 bg1 pt-5 p-b-45 p-l-15 p-r-15 respon1">
			<div class="wrappic1">
				<img src="{{asset('/landing/images/icons/customcolor_logo_transparent_background.png')}}" alt="LOGO">
			</div>
			<h1 class="txt-center py-3 font-weight-bold text-green">
				Coming Soon
			</h1>
			<p class="s1-txt4 txt-center coming-soon-text">Be among the first to experience the excitement - register your interest below  to receive  updates <br> and to be  among the first to access Clubland Services after the official launch.</p>
			<div class="row">
				<div class="col-lg-6 m-auto text-center">
                <form action="{{route('inquiry.store')}}" method="post">
                    @csrf
					<div class="wrap-input100 validate-input where1 w-100" data-validate="Email is required: ex@abc.xyz">
						<input class="s1-txt2 placeholder0 input100 w-100" required type="text" name="name" placeholder="Name">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input where1 w-100" data-validate="Email is required: ex@abc.xyz">
						<input class="s1-txt2 placeholder0 input100 w-100" required type="text" name="email" placeholder="Your Email">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input where1 w-100" data-validate="Email is required: ex@abc.xyz">
						<input class="s1-txt2 placeholder0 input100 w-100" required type="text" name="content" placeholder="Mobile Number">
						<span class="focus-input100"></span>
					</div>
					<button type="submit" class="s1-txt3 size3 how-btn trans-04 where1">
						Submit
					</button>
                </form>
				</div>
			</div>
		</div>
	</div>

	<script src="{{asset('/landing/vendor/jquery/jquery-3.2.1.min.js')}}"></script>

	<script src="{{asset('/landing/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('/landing/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
</body>

</html>