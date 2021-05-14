<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodstagram</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/404.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-7">
                <h1>Oops !</h1><br><br>
                <h3>We <span>can't</span> seem to find the page you're looking for.</h3>
                <br><br><br>
                <button onclick="goBack()" class="asdf btn btn-primary">Go back</button>
            </div>
            <div class="col-5">
                <img src="{{asset('images/404.png')}}" width="700px" height="500px" alt="asdf">
            </div>
        </div>
    </div>
    <span class="footer d-block text-center">Copyright &copy; 2020.All rights reserved.<br>DancingDogs</span>
    <script>
        function goBack() {
          window.history.back();
        }
    </script>
</body>
</html>