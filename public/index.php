<?php

include_once __DIR__.'/../vendor/autoload.php';

use App\SwissEphemeris\Repository\SwissEphemerisRepository;
use App\SwissEphemeris\SystemCheck;

// create a new object AND HAVE FUN TO USE IT
$system = new SystemCheck();
$obj = new SwissEphemerisRepository();
$obj = $obj->setIsWindows(true);

?>
<!doctype html>
<html lang="de">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Examples of the PHP Ephemeris class</title>
</head>
<body>
<div class="container-fluid">

    <!-- System Info Table -->
    <h1>Check system requirement</h1>
    <div class="row">
        <div class="col-md-6">
            <p>This data need you to configuration the class (SwissEphemeris.php) i think this is the best way do it
                statik for a beter performance</p>
            <!-- Table -->
            <table class="table table-sm table-success table-striped">
                <thead>
                <tr>
                    <th>Info</th>
                    <th>Used</th>
                    <th>ok</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td scope="row">System</td>
                    <td><?php echo $system->getSystemInfo() ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td scope="row">PHP-Version</td>
                    <td><?php echo $system->getPHP_version() ?></td>
                    <td><?php if ($system->ifPHP_versionOk()): ?>OK<?php else: ?>Not OK<?php endif; ?></td>
                </tr>
                <tr>
                    <td scope="row">PHP</td>
                    <td>exec() function</td>
                    <td><?php if ($system->is_exec_enabled()): ?>OK<?php else: ?>Not OK<?php endif; ?></td>
                </tr>
                <tr>
                    <td scope="row">PHP</td>
                    <td>putenv() function</td>
                    <td><?php if ($system->is_putenv_enabled()): ?>OK<?php else: ?>Not OK<?php endif; ?></td>
                </tr>
                <tr>
                    <td scope="row">Rights</td>
                    <td>file permission /sweph</td>
                    <td><?php if ($system->ifFilePermission()): ?>OK<?php else: ?>Not OK<?php endif; ?></td>
                </tr>
                <tr>
                    <td scope="row">Terminal-Version</td>
                    <td><?php echo $system->getTerminalInfo() ?></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <!-- Table #END -->

            <p class="h6">Run it over a windows terminal inti the object with:</p>
            <p><code>$obj = new SwissEphemerisRepository();</code></p>
            <p><code>$obj->setIsWindows(true);</code></p>
        </div>
    </div>
    <!-- System Info Table #END -->

    <hr>
    <!-- Examples -->
    <div class="row">
        <div class="col-md-4">
            <div class="list-group">
                <a href="#getDynamic1" class="list-group-item list-group-item-action">Example Query #1</a>
                <a href="#getDynamic2" class="list-group-item list-group-item-action">Example Query #2</a>

                <a href="#getMercury" class="list-group-item list-group-item-action">getMercury</a>
                <a href="#getVenus" class="list-group-item list-group-item-action">getVenus</a>
                <a href="#getMars" class="list-group-item list-group-item-action">getMars</a>
                <a href="#getJupiter" class="list-group-item list-group-item-action">getJupiter</a>

                <a href="#getSaturn" class="list-group-item list-group-item-action">getSaturn</a>
                <a href="#getUranus" class="list-group-item list-group-item-action">getUranus</a>
                <a href="#getNeptune" class="list-group-item list-group-item-action">getNeptune</a>
                <a href="#getPluto" class="list-group-item list-group-item-action">getPluto</a>
            </div>
        </div>
        <div class="col-md-8 border">
            <p class="p-3">Init a new object and get what you want from it over the repository class call: both
                example</p>
            <p><code>$obj = new SwissEphemerisRepository();</code></p>
        </div>


        <!-- Tow Cards Block -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <!-- Card Query #1 -->
            <div class="col">
                <div class="card" id="getDynamic1">
                    <div class="card-header">Function Example Query #1</div>
                    <div class="card-body">
                        <p class="card-text">
                            <code>$query = [
                                'p' => 2,
                                'b' => '1.12.1900',
                                'n' => 5,
                                's' => 2,
                                ];</code>
                        </p>
                        <p class="card-text">
                            <code>$obj->query($query)->execute();</code>
                        </p>
                        <p class="card-text">
                            <?php
                            $query = [
                                'p' => 2,
                                'b' => '1.12.1900',
                                'n' => 5,
                                's' => 2,
                            ];
                            try {
                                $obj->query($query)->execute();
                            } catch (Exception $e) {
                            }
                            print_r($obj->getOutput())
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Card Query #1 #END-->
            <!-- Card Query #2 -->
            <div class="col">
                <div class="card" id="getDynamic2">
                    <div class="card-header">Function Example Query #2</div>
                    <div class="card-body">
                        <p class="card-text">
                            <code>$query = [
                                'p' => 2,
                                'b' => '17.12.2000',
                                'n' => 5,
                                's' => 2,
                                ];</code>
                        </p>
                        <p class="card-text">
                            <code>$obj->query($query)->execute();</code>
                        </p>
                        <p class="card-text">
                            <?php
                            $query = [
                                'p' => 2,
                                'b' => '17.12.2000',
                                'n' => 5,
                                's' => 2,
                            ];
                            try {
                                $obj->query($query)->execute();
                            } catch (Exception $e) {
                            }
                            print_r($obj->getOutput())
                            ?>
                        </p>
                    </div>
                </div>
            </div><!-- Card Query #2 #END-->
        </div><!-- Tow Cards Block #END-->

        <div class="row row-cols-1 row-cols-md-4 g-4">

            <!-- Card getMercury -->
            <div class="col">
                <div class="card" id="getMercury">
                    <div class="card-header">Function getMercury</div>
                    <div class="card-body">
                        <p class="card-text"><code>print_r($obj->getMercury());</code></p>
                        <p class="card-text">
                            <?php
                            try {
                                print_r($obj->getMercury());
                            } catch (Exception $e) {
                            } ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Card getMercury #END-->

            <!-- Card getVenus -->
            <div class="col">
                <div class="card" id="getVenus">
                    <div class="card-header">Function getVenus</div>
                    <div class="card-body">
                        <p class="card-text"><code>print_r($obj->getVenus());</code></p>
                        <p class="card-text">
                            <?php
                            try {
                                print_r($obj->getVenus());
                            } catch (Exception $e) {
                            } ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Card getVenus #END-->

            <!-- Card getMars -->
            <div class="col">
                <div class="card" id="getMars">
                    <div class="card-header">Function getMars</div>
                    <div class="card-body">
                        <p class="card-text"><code>print_r($obj->getMars());</code></p>
                        <p class="card-text">
                            <?php
                            try {
                                print_r($obj->getMars());
                            } catch (Exception $e) {
                            } ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Card getMars #END-->

            <!-- Card getJupiter -->
            <div class="col">
                <div class="card" id="getJupiter">
                    <div class="card-header">Function getJupiter</div>
                    <div class="card-body">
                        <p class="card-text"><code>print_r($obj->getJupiter());</code></p>
                        <p class="card-text">
                            <?php
                            try {
                                print_r($obj->getJupiter());
                            } catch (Exception $e) {
                            } ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Card getJupiter #END-->

            <!-- Card getSaturn -->
            <div class="col">
                <div class="card" id="getSaturn">
                    <div class="card-header">Function getSaturn</div>
                    <div class="card-body">
                        <p class="card-text"><code>print_r($obj->getSaturn());</code></p>
                        <p class="card-text">
                            <?php
                            try {
                                print_r($obj->getSaturn());
                            } catch (Exception $e) {
                            } ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Card getSaturn #END-->

            <!-- Card getUranus -->
            <div class="col">
                <div class="card" id="getUranus">
                    <div class="card-header">Function getUranus</div>
                    <div class="card-body">
                        <p class="card-text"><code>print_r($obj->getUranus());</code></p>
                        <p class="card-text">
                            <?php
                            try {
                                print_r($obj->getUranus());
                            } catch (Exception $e) {
                            } ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Card getUranus #END-->

            <!-- Card getNeptune -->
            <div class="col">
                <div class="card" id="getNeptune">
                    <div class="card-header">Function getSaturn</div>
                    <div class="card-body">
                        <p class="card-text"><code>print_r($obj->getNeptune());</code></p>
                        <p class="card-text">
                            <?php
                            try {
                                print_r($obj->getNeptune());
                            } catch (Exception $e) {
                            } ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Card getNeptune #END-->

            <!-- Card getPluto -->
            <div class="col">
                <div class="card" id="getPluto">
                    <div class="card-header">Function getPluto</div>
                    <div class="card-body">
                        <p class="card-text"><code>print_r($obj->getPluto());</code></p>
                        <p class="card-text">
                            <?php
                            try {
                                print_r($obj->getPluto());
                            } catch (Exception $e) {
                            } ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Card getPluto #END-->

        </div>
        <!-- Card Set Up #END -->
    </div>

    <div class="row mt-5 mb-5 bg-light p-5">
        <div class="col-md-12">
            <p class="text-center">If you have any idea oben a <a
                        href="https://github.com/rogergerecke/SwissEphemeris/issues"
                        class="badge rounded-pill bg-primary">issue</a></p>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>