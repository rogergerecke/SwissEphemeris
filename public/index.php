<?php

include_once __DIR__ . '/../vendor/autoload.php';

use App\SwissEphemeris\SwissEphemerisRepository;

$test = new SwissEphemerisRepository();

$test->getZodiacSideral();


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

    <title>Teste es</title>
</head>
<body>
<h1>Zodiac</h1>

<hr>
<?php print_r($test); ?>
<hr>

<h2>Beispiele</h2>
<pre>
    swetest -p2 -b1.12.1900 -n15 -s2
    ephemeris of Mercury (-p2) starting on 1 Dec 1900,
    15 positions (-n15) in two-day steps (-s2)
</pre>

<?php
$Mercury = new SwissEphemerisRepository();
$query = [
    'p' => 2,
    'b' => '1.12.1900',
    'n' => 15,
    's' => 2
];
    $Mercury->query($query)->execute();
    ?>

<?php
foreach ($Mercury->getOutput() as $t) {
    if (is_array($t)) {

        foreach ($t as $item) {
            echo '<samp>' . $item . '</samp><br>';
        }

    } else {
        echo $t . '<br>';
    }

}
?>
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