<?php


namespace App\SwissEphemeris\Repository;


use App\SwissEphemeris\SwissEphemeris;
use App\SwissEphemeris\SwissEphemerisException as SwissEphemerisException;


/**
 * Class SwissEphemerisRepository
 * @package App\SwissEphemeris
 *
 * add your query's you need here see the examples both
 * you cant query's by use a $parameter array look in _parameter_description.help
 * file for more info and full option list
 */
class SwissEphemerisRepository extends SwissEphemeris
{

    /**
     * Get the software version
     * @throws SwissEphemerisException
     */
    public function getVersion()
    {
        $parameter = [
            'h' => '',
        ];

        $output = $this->query($parameter)->execute()->getOutput();

        return $output[8][0];
    }

    /**
     * @param null $date
     * @return array|string|null
     * @throws SwissEphemerisException
     *
     * Get the zodiac calendar in Spiritual mode
     */
    public function getZodiacSideral($date = null)
    {

        $parameter = [
            'b'   => $date,
            'p'   => '0123456789mt', // best planets
            'n'   => 1,
            'f'   => 'Z',
            'sid' => '1', // sideral Lahiri Ayanamsa
            'r'   => 'oundsec',


        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * @param string $id
     * @param null $date
     * @return null
     * @throws SwissEphemerisException
     */
    public function getByLetter(string $id = '0', $date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => $id,// planet

        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * Get data for planet Sun
     * @param null $date
     * @return null
     * @throws SwissEphemerisException
     */
    public function getSun($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '0',// planet

        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * Get data for planet Moon
     * @param null $date
     * @return null
     * @throws SwissEphemerisException
     */
    public function getMoon($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '1',// planet 1 Moon
            'h' => 'el', //heliocentric
        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * Get data for planet Mercury
     * @param null $date
     * @return null
     * @throws SwissEphemerisException
     */
    public function getMercury($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '2',// planet 2 Mercury
            'h' => 'el', //heliocentric

        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * Get data for planet Venus
     * @param null $date
     * @return null
     * @throws SwissEphemerisException
     */
    public function getVenus($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '3',// planet 3 Venus
            'h' => 'el', //heliocentric

        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * Get data for planet Mars
     * @param null $date
     * @return null
     * @throws SwissEphemerisException
     */
    public function getMars($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '4',// planet 4 Mars
            'h' => 'el', //heliocentric

        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * Get data for planet Jupiter
     * @param null $date
     * @return null
     * @throws SwissEphemerisException
     */
    public function getJupiter($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '5',// planet 5 Jupiter
            'h' => 'el', //heliocentric

        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * Get data for planet Saturn
     * @param null $date
     * @return null
     * @throws SwissEphemerisException
     */
    public function getSaturn($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '6',// planet 6 Saturn
            'h' => 'el', //heliocentric

        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * Get data for planet Uranus
     * @param null $date
     * @return null
     * @throws SwissEphemerisException
     */
    public function getUranus($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '7',// planet 7 Uranus
            'h' => 'el', //heliocentric

        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * Get data for planet Neptune
     * @param null $date
     * @return null
     * @throws SwissEphemerisException
     */
    public function getNeptune($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '8',// planet 8 Neptune
            'h' => 'el', //heliocentric

        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * Get data for planet Pluto
     * @param null $date
     * @return null
     * @throws SwissEphemerisException
     */
    public function getPluto($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '9',// planet 9 Pluto
            'h' => 'el', //heliocentric

        ];

        return $this->query($parameter)->execute()->getOutput();
    }
}