## Swiss Ephemeris PHP Classes

With these PHP classes you can query the ***Swiss Ephemeris Software*** which is based on ***VB***. 
With the PHP class, the position of astrological objects is queried via the ***exec()*** function through the terminal. 
My idea for the query was to use a kind of repository class to comfortably configure the query to the ***table file (.eph)***. 
If you have any suggestions for improvement, write to me on ***GITHUB***.

###To begin, read this README.md file carefully

---

####Important:
>This software only works with the ***.eph*** files.
>These must be in the ***/sweph*** folder or the path to the file must be specified in the constructor.
>I have included a small ***.eph*** table with a small time range


The best way to use this classes
---
Install via Composer Dependency Manager to your project a PHP project on an Linux system 
on (*Windows are having problems because the commands are sent to the cmd.exe.*).
Add to your composer.json file and run `composer update`  after that ***move the .se1 
files from /demo to /sweph*** folder.
```

"repositories": [
    {
      "type": "github",
      "name": "rogergerecke/swiss-ephemeris",
      "url": "https://github.com/rogergerecke/SwissEphemeris.git"
    }
  ],
  "require": {
  "rogergerecke/swiss-ephemeris": "*",
  }
  
```





Notice
---

**EN**

Getting Planets Position using PHP & AstroDienst Swiss Ephemeris library.  Use the Repository class to extend it for your need.
>**Tip:** Extend the SwissEphemerisRepository class

Examples of use in index.php or SwissEphemerisRepository.php

**DE**

Zur berechnung verschidenen Astrologischer Objekt-Position Basis zur berechnung sind die Daten von
[http://www.astro.com/ftp/swisseph/ephe/ ](http://www.astro.com/ftp/swisseph/ephe/ )

>**Tip:** Erweitere die SwissEphemerisRepository class

Für Beispiele schau dir die index.php an oder die SwissEphemerisRepository.php

>**INFO:** Zur Anwendung auf Linux-Systemen oder in dem mitgelieferten Docker-Container bei 
> Windows gibt es Probleme da die befehle an die cmd.exe geschickt werden.

---

Info to Swiss Ephemeris
---
[Swiss Ephemeris Website](https://www.astro.com/swisseph/swephinfo_e.htm)

[Swiss Ephemeris Download lib](http://www.astro.com/ftp/swisseph/)

[Swiss Ephemeris Examples Interface](https://www.astro.com/ftp/swisseph/doc/swephprg.htm)

[Swiss Ephemeris Examples](https://www.astro.com/ftp/swisseph/doc/swisseph.htm)

[Other Ephemeris Data](https://ssd.jpl.nasa.gov/?planet_eph_export)

[Swiss Ephemeris mailing list](https://groups.io/g/swisseph)

## Not Include the de441
In the demo Folder you have .se1 files as examples move all to /sweph folder
its work for example.  Otherwise, copy a .eph file to the folder it's big.

---------

##### Download DE441.eph file have 2.7 GB

> Download files with time range you need from ftp:astro.ch or 
> un-compiled from ssd.jpl.nasa.gov as ascii compiled under Linux 
> with https://github.com/Bill-Gray/jpl_eph

DE441 : Created June 2020; compared to DE431, about 7 years of new data have
been added.
Referred to the International Celestial Reference Frame version 3.0.
Covers JED -3100015.5, (-13200 AUG 15) to JED 8000016.50, (17191 MAR 15).

        DE440 and DE441 are documented in the following document:
        https://doi.org/10.3847/1538-3881/abd414
        (NOTE: this paper has been accepted for publication in December, 2020;
         this link will become available sometime in January)

-------------
Changelog:
---

UPDATE 2.1.4
---
- Add Windows 10 support (thanks for Iusses @HSBSINGH)
- Add demo files to /demo folder
- Add requirement view in index.php

UPDATE 2.1.3
---
- Update to new Time Range 30000 years
- Update to wonderful Swiss Ephemeris 2.10.01
- To PHP 7.4.18
- Remove unused Dockerfile lib's

UPDATE 2.1.0
---
- Update to wonderful Swiss Ephemeris 2.0.8
- Extend Repository class
- Update the README.md

Help and Question
---
Do you want more flexibility or have you found a mistake? Open an issues

[Open Issues](https://github.com/rogergerecke/SwissEphemeris/issues)

Please open a Issues if you have a good idea


Docker Help
---


Update the php version in an existing docker-container change the PHP version in the Dockerfile
and run the both commands.

````
 docker-compose build --no-cache --pull YOUR_CONTAINER_NAME
 docker-compose up -d
````

TEST
---
in /public/index.php