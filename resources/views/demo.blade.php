<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wedding Event Uploader</title>

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>
<body>

    <form id="image-upload" action="{{ url('upload-photos') }}" method="POST" class="dropzone">
        @csrf
    </form>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.imageUpload = {
            paramName: "image", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            dictRemoveFile: "Remove",
            acceptedFiles: "image/*",
            init: function () {
                this.on("success", function (file, response) {
                    console.log(response);
                });

                this.on("sending", function (file, xhr, formData) {
                    formData.append('event', '{{request()->segment(2)}}');
                    formData.append('token', '{{request()->segment(3)}}');
                });
            }
        };
    </script>
</body>
</html>