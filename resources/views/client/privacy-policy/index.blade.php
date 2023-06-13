<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Privacy Policy</title>
    <style>
        .bg-dark{
            background-color: #1F2119;
        }

        .text-white{
            color: white
        }

        .text-grey{
            color: rgb(176, 176, 176)
        }

        .text-center{
            text-align: center
        }

        .p-5{
            padding: 25px
        }
    </style>
</head>
<body class="bg-dark">
    <div>
        <h1 class="text-white text-center">Privacy Policy</h1>
    </div>
    <div class="text-grey p-5">
        {!! $privacyPolicy->description  !!}
    </div>
</body>
</html>
