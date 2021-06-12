<?php

include_once __DIR__.'/../vendor/autoload.php';

use App\SwissEphemeris\Repository\SwissEphemerisRepository;

// create a new object AND HAVE FUN TO USE IT
$obj = new SwissEphemerisRepository();

?>
<!doctype html>
<html lang="de">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Examples of the PHP Ephemeris class</title>
</head>
<body>
<div class="container-fluid">
    <h1>Examples of the PHP Ephemeris class</h1>
    <p>How whe can use this class</p>

<!-- Sodijac -->
    <div class="row bg-info p-5">
        <div class="col-md-6">
            <h2>Example: Zodiac Sidereal</h2>
            <pre>
<code>
 // create a new object AND HAVE FUN TO USE IT
$obj = new SwissEphemerisRepository();
print_r($obj->getZodiacSideral());
 </code>
 </pre>
        </div>

        <div class="col-md-6">
            <p>output:</p>
            <div class="alert alert-secondary" role="alert">
                <?php print_r($obj->getZodiacSideral()); ?>
            </div>
        </div>
    </div>

    <hr>
    <!-- Sodijac #END-->

    <!-- Sun -->
    <div class="row bg-warning p-5">
        <div class="col-md-6">
            <h2>Example: SUN <small>Use the Repository class</small></h2>
            <pre>
<code>
 // create a new object AND HAVE FUN TO USE IT
$obj = new SwissEphemerisRepository();
print_r($obj->getSun());
 </code>
 </pre>
        </div>

        <div class="col-md-6">
            <p>output:</p>
            <div class="alert alert-secondary" role="alert">
                <?php print_r($obj->getSun()); ?>
            </div>
        </div>
    </div>

    <hr>
    <!-- Sun #END -->

    <div class="row">
        <div class="col-md-6">
            <h2 class="h6">Example use dynamic query -------></h2>
            <pre>
<code>
swetest -p2 -b1.12.1900 -n15 -s2
ephemeris of Mercury (-p2) starting on 1 Dec 1900,
15 positions (-n15) in two-day steps (-s2)

     $query = [
         'p' => 2,
         'b' => '1.12.1900',
         'n' => 15,
         's' => 2
     ];
     $obj->query($query)->execute();
     print_r($obj->getOutput())
 </code>
</pre>
        </div>
        <div class="col-md-6">
            <p>output:</p>
            <div class="alert alert-secondary" role="alert">
                <?php
                $query = [
                    'p' => 2,
                    'b' => '1.12.1900',
                    'n' => 15,
                    's' => 2,
                ];
                $obj->query($query)->execute();
                print_r($obj->getOutput())
                ?>

            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <h3 class="h6">Example with repository class -----></h3>
            <div class="alert alert-success" role="alert">
                Tip: I think extend the repository class for your needs is the best patrice
            </div>
            <pre>
        <code>
// output venus data from today
print_r($obj->getVenus()
        </code>
    </pre>
        </div>
        <div class="col-md-6">
            <p>output:</p>
            <div class="alert alert-danger" role="alert">
                <?php print_r($obj->getVenus()) ?>
            </div>
        </div>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>