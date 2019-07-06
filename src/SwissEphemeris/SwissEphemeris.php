<?php


namespace App\SwissEphemeris;

use App\SwissEphemeris\SwissEphemerisException as SwissEphemerisException;
use DateTime;
use DateTimeZone;
use Exception;

/**
 * Class SwissEphemeris
 * @package App\Lotto\Algoritmo\Astronomie\SwissEphemeris
 */
class SwissEphemeris
{
    // path to swiss ephemeris library files
    /**
     * @var
     */
    protected $lib_phat;

    protected $name;
    /**
     * Latitude Longitude
     * of Ulzburg, Germany
     */
    protected $latitude = 53.925724699999996;
    protected $longitude = 9.8570529;

    /**
     * Timezone value for Europe/Berlin
     * 2 hours ahead of UTC
     *
     * Put this value according to your country
     */
    protected $timezone = 'Europe/Berlin';


    /*
     * 3600 seconds * timezone = offset
     *
     * */
    protected $offset;

    protected $time;

    protected $date;

    protected $query = null;

    /*
     *  Output format SEQ letters:
     *  In the standard setting five columns of coordinates are printed with
     *  the default format PLBRS. You can change the default by providing an
     *  option like -fCCCC where CCCC is your sequence of columns.
    */

    /**
     * @var string
     */
    protected $output_format = 'PLBRS';


    /**
     * @var string
     * type PHP_ARRAY, JSON, PLAIN
     */
    protected $output_render_type = 'PHP_ARRAY';


    /**
     * @var null
     * save in output the response from the console exec in a single string
     */
    protected $response = null;


    /**
     * @var null
     * save in output the response from the console exec in a array
     */
    protected $output = null;


    /**
     * @var string
     * delimiter for explode output to array
     */
    protected $delimiter = ',';

    /**
     * @var null
     * status code from the response of console exec
     */
    protected $status = null;

    protected $debug_header = FALSE;

    protected $default_phat = '/sweph/';


    /**
     * SwissEphemeris constructor.
     * @param null $lib_phat
     * @param bool $debug
     * @throws \App\SwissEphemeris\SwissEphemerisException
     */
    public function __construct($lib_phat = null, $debug = FALSE)
    {
        // use default library phat
        if (is_null($lib_phat) or empty($lib_phat)) {
            $lib_phat = __DIR__ . $this->default_phat;
        }
        $this->setLibPhat($lib_phat);


        // debug mode on?
        if ($debug) {
            $this->setDebugHeader(TRUE);
        }

    }

    /**
     * @return mixed
     */
    public function getLibPhat()
    {
        return $this->lib_phat;
    }


    /**
     * @param $lib_phat
     * @return $this
     * @throws SwissEphemerisException
     */
    public function setLibPhat($lib_phat)
    {

        if (is_dir($lib_phat) and is_file($lib_phat . 'swetest')) {

            putenv('PATH=' . $lib_phat); //console script need phat variable !!!!
            //**************************************************************************

            $this->lib_phat = $lib_phat;

        } else {

            throw new SwissEphemerisException('Invalid path!');

        }

        return $this;

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }


    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getTimezone()
    {
        // todo  http://api.geonames.org/timezoneJSON?lat=47.01&lng=10.2&username=demo
        return $this->timezone;
    }

    /**
     * @param mixed $timezone
     */
    public function setTimezone($timezone): void
    {
        $this->timezone = $timezone;
    }


    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param
     */
    public function setOffset(): void
    {
        $offset = $this->getTimezone() * (60 * 60);

        $this->offset = $offset;
    }


    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time): void
    {

        $this->time = date('H:i:s', $time);
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * @param $date
     * @throws Exception
     */
    public function setDate($date): void
    {
        // if date null set date now
        if (is_null($date)) {
            $date = new DateTime('NOW', new DateTimeZone($this->timezone));
            $date = $date->format('d.m.Y');
        }

        $this->date = $date;
    }


    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * @param array $query
     */
    public function setQuery(array $query): void
    {
        $this->query = $query;
    }

    /**
     * @return null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param null $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getOutputFormat(): string
    {
        return $this->output_format;
    }

    /**
     * @param string $output_format
     */
    public function setOutputFormat(string $output_format): void
    {
        $this->output_format = $output_format;
    }

    /**
     * @return string
     */
    public function getOutputRenderType(): string
    {
        return $this->output_render_type;
    }

    /**
     * @param string $output_render_type
     */
    public function setOutputRenderType(string $output_render_type): void
    {
        $this->output_render_type = $output_render_type;
    }


    /**
     * @return null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param null $response
     */
    public function setResponse($response): void
    {
        $this->response = $response;
    }

    /**
     * @return null
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param null $output
     */
    public function setOutput($output): void
    {
        $this->output = $output;
    }


    /**
     * @return string
     */
    public function getDelimiter(): string
    {
        return $this->delimiter;
    }

    /**
     * @param string $delimiter
     */
    public function setDelimiter(string $delimiter): void
    {
        $this->delimiter = $delimiter;
    }


    /**
     * @return bool
     */
    public function isDebugHeader(): bool
    {
        return $this->debug_header;
    }

    /**
     * @param bool $debug_header
     */
    public function setDebugHeader(bool $debug_header): void
    {
        $this->debug_header = $debug_header;
    }

    /*
     * QUERY BUILD
     * */

    /**
     * Query array to string transformation
     * @param $query
     * @return string
     * @throws Exception
     */
    public function compiler($query)
    {
        $options = [];

        // if date not in array add date now ex. 17.7.1982 (d.m.y)
        if (!array_key_exists('b', $query) or is_null($query['b'])) {
            $this->setDate(null);
            $query['b'] = $this->getDate();
        }

        // compile array to query string
        foreach ($query as $key => $value) {
            $options[] = is_int($key) ? '-' . $value : '-' . $key . $value;
        }

        // set standard output format for response
        if (!array_key_exists('f', $query) or is_null($query['f'])) {
            $options[] = '-f' . $this->getOutputFormat();
        }

        // set standard delimiter
        if (!array_key_exists('g', $query) or is_null($query['g'])) {
            $options[] = '-g' . $this->getDelimiter();
        }


        // if debug mode on add query option
        if (!$this->isDebugHeader()) {
            // by default remove header
            $options[] = '-head';
        }

        return implode(' ', $options);
    }


    /**
     * @param $query
     * @return $this
     * @throws Exception
     */
    public function query($query)
    {

        // if array given compile
        if (is_array($query) and !empty($query)) {
            $query = $this->compiler($query);
        }

        // if query empty exception
        if (is_null($query)) {
            throw new SwissEphemerisException('Query cant not be empty!');
        }

        $this->query = "swetest -edir$this->lib_phat $query";

        return $this;
    }


    /**
     * @param $output
     * @return array[]|false|string[]
     */
    public function splitOutput($output)
    {
        return preg_split("~$this->delimiter~", $output, -1, PREG_SPLIT_NO_EMPTY);
    }

    public function outputEncoder($output)
    {
        switch ($this->getOutputRenderType()) {
            case 'PHP_ARRAY':
                $output = $this->encodePhpArray($output);
                break;
            case 'JSON':
                $output = $this->encodeJson($output);
                break;
            default:
                return $output;

        }

        return $output;
    }

    public function encodePhpArray($output)
    {
        // is it array
        if (is_array($output)) {

            $php_array = null;

            foreach ($output as $value) {

                // have delimiter ,
                if ($this->isDelimiter($value)) {
                    $php_array[] = $this->splitOutput($value);

                    // have no delimiter
                } else {
                    $php_array = $output;
                }

            }

            $output = $php_array;
        }


        return $output;
    }

    public function encodeJson($output)
    {
// todo
        return $output;
    }


    /**
     * @param $value
     * @return bool
     */
    public function isDelimiter($value)
    {
        if (preg_match("~$this->delimiter~", $value)) {
            return true;
        } else {
            return false;
        }
    }

    public function getSiderealMethodName($sid = null)
    {

        $sidereal = [
            0 => 'Fagan/Bradley',
            1 => 'Lahiri',
            2 => 'De Luce',
            3 => 'Raman',
            4 => 'Ushashashi',
            5 => 'Krishnamurti',
            6 => 'Djwhal Khul',
            7 => 'Yukteshwar',
            8 => 'J.N. Bhasin',
            9 => 'Babylonian/Kugler 1',
            10 => 'Babylonian/Kugler 2',
            11 => 'Babylonian/Kugler 3',
            12 => 'Babylonian/Huber',
            13 => 'Babylonian/Eta Piscium',
            14 => 'Babylonian/Aldebaran = 15 Tau',
            15 => 'Hipparchos',
            16 => 'Sassanian',
            17 => 'Galact. Center = 0 Sag',
            18 => 'J2000',
            19 => 'J1900',
            20 => 'B1950',
            21 => 'Suryasiddhanta',
            22 => 'Suryasiddhanta, mean Sun',
            23 => 'Aryabhata',
            24 => 'Aryabhata, mean Sun',
            25 => 'SS Citra',
            26 => 'SS Revati',
            27 => 'True Citra',
            28 => 'True Revati',
            29 => 'True Pushya',
            30 => 'Galactic (Gil Brand)',
            31 => 'Galactic Equator (IAU1958)',
            32 => 'Galactic Equator',
            33 => 'Galactic Equator mid-Mula',
            34 => 'Skydram (Mardyks)',
            35 => 'True Mula (Chandra Hari)',
            36 => 'Dhruva/Gal.Center/Mula (Wilhelm)',
            37 => 'Aryabhata 522',
            38 => 'Babylonian/Britton',

        ];

        return $sidereal[$sid];

    }

    /**
     * @return $this
     * @throws Exception
     */
    public function execute()
    {
        // More about command line options: https://www.astro.com/cgi/swetest.cgi?arg=-h&p=0
        exec($this->query, $output, $status);


        // if debug true dont encode output
        if ($this->isDebugHeader()) {
            $this->setOutputRenderType('PLAIN');
        }


        // if query use sidereal function 0 - 38
        if (preg_match('/-sid([0-3,0-8]+)/', $this->query, $matches)) {
            // cutout sidereal function id
            // set sidereal name
            $this->setName($this->getSiderealMethodName($matches[1]));
        } else {

            // else set the name of the planet
            $this->setName($output[0]);
        }

        // output
        $this->response = $output;
        $this->output = $this->outputEncoder($output);
        $this->status = $status;

        // unknown error query syntax error
        if ($this->status === 127) {
            throw new SwissEphemerisException('Illegal command!');
        }

        return $this;
    }


}