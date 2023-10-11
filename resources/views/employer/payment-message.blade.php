<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Result</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            background: #eaeff4;
        }

        .message-container {
            background: #fff;
        }
    </style>
</head>
<body>

    <div class="message-container container d-flex justify-content-center align-items-center rounded mt-5" style="min-height: 40vh;">
        <div>
            <h1>Payment Result</h1>
            <hr>
            @if($response->status === "Paid")
                <h3>Status: {{ $response->status }} <i class="text-success fa-regular fa-circle-check"></i></h3>
            @else
                <h3>Status: {{ $response->status }} <i class="text-danger fa-solid fa-circle-exclamation"></i></h3>
            @endif
            <p>Payment Date: {{ $response->paid_at }}</p>
            <a href="{{url('/employer/jobs')}}" class="btn btn-outline-primary btn-block">Go back to job list</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>