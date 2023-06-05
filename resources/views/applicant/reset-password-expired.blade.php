<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

    <!-- Bootstrap cdn -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    
    <title>Reset Password</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <style>
        body, html {
            margin: 0;
            padding: 0;
        }

        .expired-container {
            font-family: Arial;
            background: #c62828;
            width: 100%;
            padding: 20px;
            text-align: center;
            color: #fff;
        }
    </style>
</head>
<body class="user-select-none">

    <div class="expired-container">Token link is expired.</div>

</body>
</html>