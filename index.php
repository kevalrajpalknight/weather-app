<!DOCTYPE html>
<html>
    <head>
        <title>Current Weather App</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    </head>
    <body>
        <div class="d-flex bd-highlight text-align-center justify-content-center mt-5">
            <div class="card">
                <div class="card-header">
                    <h1 class="display1">Current Weather App</h1>
                </div>
                <div class="card-body">
                    <form action="get_weather.php" method="POST">
                        <div class="d-flex mb-4">
                            <label for="exampleInputCity1" class="form-label mb-3 mx-2">City</label>
                            <input type="text" class="form-control" id="exampleInputCity1" aria-describedby="emailHelp" name="city">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>