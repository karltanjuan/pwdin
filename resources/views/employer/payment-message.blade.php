<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Result</title>
</head>
<body>
    <h1>Payment Result</h1>
    <p>Status: {{ $response->status }}</p>
    <p>Payment Date: {{ $response->paid_at }}</p>
</body>
</html>