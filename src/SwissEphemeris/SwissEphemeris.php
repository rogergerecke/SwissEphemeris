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
    /**
     * @var
     * path to swiss ephemeris library files
     */
    protected $lib_phat;

    /**
     * @var
     */
    protected $name;
    /**
     * Latitude Longitude
     * of Henstedt-Ulzburg, Germany
     * my view position to the all
     */
    protected $latitude = '53,925724699999996';
    /**
     * @var float
     */
    protected $longitude = '9,8570529';


    /**
     * Use variable above
     * @var bool
     */
    protected $geopositon = true;
    /**
     * Timezone value for Europe/Berlin
     * 2 hours ahead of UTC
     *
     * Put this value according to your country
     * for your origin position view
     */
    protected $timezone = 'Europe/Berlin';


    /*
     * 3600 seconds * timezone = offset
     *
     * */
    /**
     * @var
     */
    protected $offset;

    /**
     * @var
     */
    protected $time;

    protected $terminal_tool = '';

    /**
     * @var
     */
    protected $date;

    /**
     * The query parameters.
     *
     * @var string|null
     */
    protected ?string $query = null;

    /*
     *  Output format SEQ letters:
     *  In the standard setting five columns of coordinates are printed with
     *  the default format PLBRS. You can change the default by providing an
     *  option like -fCCCC where CCCC is your sequence of columns.
    */
    /**
     * @var string
     * PLBRS is the standart output format with five array keys [0]-> .. [4]
     * - P planet name
     * - L longitude in degree ddd mm'ss"
     * - B latitude degree
     * - R distance decimal in AU
     * - S speed in longitude in degree ddd:mm:ss per day
     */
    protected $output_format = 'PLBRS';


    /**
     * @var string
     * Default PHP_ARRAY other : JSON, PLAIN
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


    /**
     * @var bool
     * show the debug header output = FALSE
     */
    protected bool $debug_header = false;

    /**
     * Show the header for each response row.
     *
     * @var boolean
     */
    protected bool $header_for_each_row = false;

    protected bool $isWindows = false;

    protected string $default_eph_file = 'DE441.eph';

    /**
     * @var string
     * phat to the swiss lib you cant set the phat to other swiss lib over constructor
     */
    protected string $default_phat = '/sweph/';


    /**
     * SwissEphemeris constructor.
     * @param null $lib_phat
     * @param null $eph_file
     * @param bool $debug
     * @throws \App\SwissEphemeris\SwissEphemerisException
     */

    public function __construct($lib_phat = null, $eph_file = null, bool $debug = false)
    {
        // use default library phat
        if (!is_null($lib_phat)) {
            $this->setLibPhat($lib_phat);
        }

        if (is_null($lib_phat)) {
            $this->setLibPhat(__DIR__.$this->default_phat);
        }

        // -ejpl
        if (!is_null($eph_file)) {
            $this->setDefaultEphFile($eph_file);
        }

        // debug mode on?
        if ($debug) {
            $this->setDebugHeader(true);
        }

    }

    /**
     * @return bool
     */
    public function isWindows(): bool
    {
        return $this->isWindows;
    }

    /**
     * @param bool $isWindows
     * @return SwissEphemeris
     */
    public function setIsWindows(bool $isWindows): SwissEphemeris
    {
        $this->isWindows = $isWindows;

        return $this;
    }


    /**
     * @return string
     */
    public function getDefaultEphFile(): string
    {
        return $this->default_eph_file;
    }

    /**
     * @param mixed|string $default_eph_file
     */
    public function setDefaultEphFile($default_eph_file): void
    {
        $this->default_eph_file = $default_eph_file;
    }


    /**
     * @return mixed
     */
    public function getLibPhat()
    {
        return $this->lib_phat;
    }


    /**
     * Set the library path for the query moment in the $ENV is the path
     * false the function return nothing.
     *
     * @param $lib_phat
     * @return $this
     * @throws SwissEphemerisException
     */
    public function setLibPhat($lib_phat): SwissEphemeris
    {

        if ($this->isWindows) {
            // add slashes
            $lib_phat = str_replace(['\\', '/'], '\\\\', $lib_phat);
        }

        if (is_dir($lib_phat) and is_file($lib_phat.'swetest')) {

            //console script need phat variable this variable is set only for request and request time!!!!
            // safe_mode_allowed_env_vars must allow by your hoster
            putenv('PATH='.$lib_phat);
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
     * Setter for terminal name
     * @param string $terminal_tool
     */
    public function setTerminalTool(string $terminal_tool): void
    {
        $this->terminal_tool = $terminal_tool;
    }


    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * todo add
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
     * todo add
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
     * @throws SwissEphemerisException|Exception
     */
    public function setDate($date): void
    {
        // if date null set date now
        if (is_null($date)) {
            $date = new DateTime('NOW', new DateTimeZone($this->timezone));
            $date = $date->format('d.m.Y'); // Germany date format
        }

        $this->date = $date;
    }

    /**
     * Gets the query parameters string.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * Sets the query parameters string.
     *
     * @param string $query
     * @return void
     */
    public function setQuery(string $query): void
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
     * Default PHP_ARRAY
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

    public function isHeaderForEachRow(): bool
    {
        return $this->header_for_each_row;
    }

    /**
     * Set whether to print headers for each line of the response.
     * 
     * @param bool $debug_header
     * @param bool $for_each_row Specifies to print an header for each response row.
     */
    public function setDebugHeader(bool $debug_header, bool $for_each_row = false): void
    {
        $this->debug_header = $debug_header;
        $this->header_for_each_row = $for_each_row;
    }

    /*
     * QUERY BUILD
     * */

    /**
     * Convert the query array to string for the console:
     * swetest -p2 -b1.12.1900 -n15 -s2 -fTZ -roundsec -g, -head
     *
     * @param $query
     * @return string
     * @throws \App\SwissEphemeris\SwissEphemerisException
     */
    public function compiler($query): string
    {
        $options = [];

        // if date not in array add date now ex. 17.7.1982 (d.m.y)
        if (!array_key_exists('b', $query) or is_null($query['b'])) {
            $this->setDate(null);
            $query['b'] = $this->getDate();
        }

        // if geo-position use true (default Green Witch) TODO dont work collision ? heliocentric
        if ($this->geopositon) {
            $options[] = '-geopos'.$this->longitude.'.'.$this->latitude;
        }

        // library path
        if ($this->lib_phat) {
            $options[] = '-edir'.$this->lib_phat;
        }

        // add the eph file
        if ($this->default_eph_file) {
            $options[] = '-ejpl'.$this->default_eph_file;
        }

        // compile array to query string
        foreach ($query as $key => $value) {
            $options[] = is_int($key) ? '-'.$value : '-'.$key.$value;
        }

        // set standard output format for response
        if (!array_key_exists('f', $query) or is_null($query['f'])) {
            $options[] = '-f'.$this->getOutputFormat();
        }

        // set standard delimiter
        if (!array_key_exists('g', $query) or is_null($query['g'])) {
            $options[] = '-g'.$this->getDelimiter();
        }

        $this->setDebugHeader(true, false);
        // if debug mode on add query option
        if (!$this->isDebugHeader()) {
            // by default remove header debug = FALSE
            $options[] = '-head';
        } elseif ($this->isHeaderForEachRow()) {
            $options[] = "+head";
        }

        return implode(' ', $options);
    }


    /**
     * This function build the query string
     * @param $query
     * @return $this
     * @throws \App\SwissEphemeris\SwissEphemerisException
     */
    public function query($query): SwissEphemeris
    {

        // run query with array of option compiled to a string for the console
        if (is_array($query) and !empty($query)) {
            $query = $this->compiler($query);
        }

        // if query empty error shown
        if (is_null($query)) {
            throw new SwissEphemerisException('Query cant not be empty!');
        }

        // save the full query string for console ready to ->execute() the console
        if (!$this->isWindows) {
            $this->setQuery("swetest $query");
        }

        if ($this->isWindows) {
            $this->setQuery("swetest.exe $query");
        }

        return $this;
    }


    /**
     * @param $output
     * @return array[]|false|string[]
     */
    public function splitOutput($output)
    {
        if (is_array($output)) {

            $array = [];
            foreach ($output as $line) {
                $array = preg_split("~$this->delimiter~", $line, -1, PREG_SPLIT_NO_EMPTY);
            }

        } else {

            return preg_split("~$this->delimiter~", $output, -1, PREG_SPLIT_NO_EMPTY);

        }

        return $array;

    }

    /** Default PHP_ARRAY
     * @param $output
     * @return array|mixed|null
     */
    public function outputEncoder($output)
    {
        switch ($this->getOutputRenderType()) {
            case 'PHP_ARRAY':
                $output = $this->encodePhpArray($output);
                break;
            case 'JSON':
                $output = $this->encodeJson($output);
                break;
            case 'PLAIN':
                // nothing to do;
            default:
                return $output;

        }

        return $output;
    }

    /**
     * @param $output
     * @return array|null
     */
    public function encodePhpArray($output): ?array
    {
        $php_array = array();
        $i = 0;
        if (is_array($output)) {

            foreach ($output as $value) {

                $php_array[$i] = $this->splitOutput($value);
                $php_array[$i]['name'] = $this->getName();
                $i++;
            }
        }

        return $php_array;
    }


    /**
     * @param $output
     * @return false|string
     */
    public function encodeJson($output)
    {
        return json_encode($output);
    }


    /**
     * Check if the console response array have delimiter in string.
     * @param $value
     * @return bool
     */
    public function isDelimiter($value): bool
    {
        if (preg_match("~$this->delimiter~", $value)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Return the real name of the Sidereal Methode
     * @param int|null $sid
     * @return string
     */
    public function getSiderealMethodName(int $sid = null): string
    {

        $sidereal = [
            0  => 'Fagan/Bradley',
            1  => 'Lahiri',
            2  => 'De Luce',
            3  => 'Raman',
            4  => 'Ushashashi',
            5  => 'Krishnamurti',
            6  => 'Djwhal Khul',
            7  => 'Yukteshwar',
            8  => 'J.N. Bhasin',
            9  => 'Babylonian/Kugler 1',
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
            39 => ' Vedic/Sheoran',
            40 => ' Cochrane (Gal.Center = 0 Cap)',
            41 => 'Galactic Equator (Fiorenza)',
            42 => 'Vettius Valens',
            43 => 'Lahiri 1940',
            44 => 'Lahiri VP285 (1980)',
            45 => 'Krishnamurti VP291',
            46 => 'Lahiri ICRC',

        ];

        return $sidereal[$sid];

    }

    /**
     * Execute the string: Fired to the shell and query the astro c-basic
     * @return SwissEphemeris
     * @throws \App\SwissEphemeris\SwissEphemerisException
     */
    public function execute(): SwissEphemeris
    {
        // More about command line options: https://www.astro.com/cgi/swetest.cgi?arg=-h&p=0
        exec($this->query, $output, $status);

        //handle empty response from shell exec
        if (!is_array($output) or empty($output)) {
            throw new SwissEphemerisException(
                'You have a empty shell response have you put valid data to the execute command'
            );
        }

        // save status code
        $this->status = $status;


        // if debug true dont encode output
        if ($this->isDebugHeader()) {
            $this->setOutputRenderType('PLAIN');
        }


        // if query use sidereal function 0 - 48
        if (preg_match('/-sid([0-4,0-8]+)/', $this->query, $matches)) {
            // cutout sidereal function id
            // set sidereal name
            $this->setName($this->getSiderealMethodName($matches[1]));
        } else {

            // else set the name of the planet
            $name = $this->splitOutput($output);
            $this->setName($name[0]);
        }

        // save output
        $this->response = $output;
        $this->output = $this->outputEncoder($output);

        // unknown error query syntax error
        if ($this->status === 127) {
            throw new SwissEphemerisException('Illegal command: unknown error query syntax error!');

        }

        if (empty($this->status) and $this->status != 0) {
            throw new SwissEphemerisException('Unknown: Console return nothing? path failure!');
        }


        return $this;
    }
}