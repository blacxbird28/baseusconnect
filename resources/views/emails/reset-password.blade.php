<html>

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <style>
    body {
      position: relative;
      margin: 0;
    }
    .container {
      position: relative;
      width: 80%;
      margin: 0 auto;
      text-align: justify;
      overflow: hidden;
    }
    .main-title {
      color: #000;
      font-size: 22px;
      font-family: "Roboto", serif;
      font-weight: bold;
    }
    .main-content {
      color: #000;
      font-family: "Roboto", serif;
      font-size: 16px;
      margin-bottom: 0;
    }
    .thanks {
      color: #000;
      font-family: "Roboto", serif;
      font-weight: bold;
      font-size: 18px;
    }
    .pink-line {
      background: #000;
      width: 100%;
    }
    .footer {
      width: 100%;
    }
    .store {
      color: #fff;
      font-family: "Roboto", serif;
      font-size: 14px;
      text-align: center;
      margin-bottom: 0;
    }
    .store a {
      color: #fff;
      font-family: "Roboto", serif;
    }
    .button {
      width: 150px;
      padding: 10px;
      text-align: center;
      margin: 20px auto;
      display: block;
      background: #fff100;
      color: #000;
      text-decoration: none;
      border-radius: 5px;
      font-family: "Roboto", serif;
    }
  </style>
</head>
<body>
  <div class="container">
    <div style="padding: 20px;">
      <img src="{{asset('images/logo-baseus-connect.png')}}" alt="" style="display: block; margin: 30px auto 50px; text-align: center; width: 300px;">
      <h2 class="main-title">Reset Your Password</h2>
      <div class="main-content">
        <h3>Hi {{ $user->name }},</h3>
        <p>You requested a password reset. Click the button below to set a new password.</p>

        <a href="{{ $resetUrl }}" class="button">Reset Password</a>

        <p>If you didn’t request this, you can safely ignore this email.</p>

        <p class="thanks">Thanks, Baseus Connect</p>

      </div>


    </div>
    <img src="{{asset('images/defider.png')}}" alt="" style="display: block; width: 100%; height: 30px;">

    <div class="pink-line" style="padding:20px 0;">
      <p class="store"><b>Temukan produk di official store</b><br />
      Instagram : <a href="https://www.instagram.com/baseus.idn/" target="_blank" style="margin-right: 10px;">@baseus.idn</a> Shopee : <a href="https://shopee.co.id/baseusoffice.store?categoryId=100013&entryPoint=ShopByPDP&itemId=25740209426&upstream=search" target="_blank" style="margin-right: 10px;">baseus.id</a> TikTok : <a href="https://www.tiktok.com/@baseus.id?lang=en" target="_blank">Baseus Official Shop</a> </p>
    </div>
  </div>
</body>
</html>
