<?php


namespace App\SwissEphemeris;


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
     * @param null $date
     * @return string|array
     * @throws \Exception
     *
     * Get the zodiac calendar in Spiritual mode
     */
    public function getZodiacSideral($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '0123456789mt', // best planets
            'n' => 1,
            'f' => 'Z',
            'sid' => '1', // sideral Lahiri Ayanamsa
            'r' => 'oundsec'


        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * @param null $date
     * @param string $id
     * @return |null
     * @throws \Exception
     *
     * Get only data for planet
     */
    public function getByLetter($id = '0', $date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => $id,// planet

        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * @param null $date
     * @return |null
     * @throws \Exception
     *
     * Get only data for planet SUN
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
     * @param null $date
     * @return null |null
     * @throws \Exception
     * Get only data for planet MOON heliocentric
     */
    public function getMoon($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '1',// planet 1 Moon
            'h' => 'el'
        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * @param null $date
     * @return null |null
     * @throws \Exception
     * Get only data for planet MERCURY heliocentric
     */
    public function getMercury($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '2',// planet 2 Mercury
            'h' => 'el'

        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * @param null $date
     * @return null |null
     * @throws \Exception
     * Get only data for planet VENUS heliocentric
     */
    public function getVenus($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '3',// planet 3 Venus
            'h' => 'el'

        ];

        return $this->query($parameter)->execute()->getOutput();
    }

    /**
     * @param null $date
     * @return null |null
     * @throws \Exception
     * Get only data for planet mars heliocentric
     */
    public function getMars($date = null)
    {

        $parameter = [
            'b' => $date,
            'p' => '4',// planet 4 Mars
            'h' => 'el'

        ];

        return $this->query($parameter)->execute()->getOutput();
    }



}