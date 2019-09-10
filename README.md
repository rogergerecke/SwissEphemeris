Swiss Ephemeris PHP Classes

Getting Planets Position using PHP & AstroDienst Swiss Ephemeris library.  Use the Repository class to extend it for your need.

Zur berechnung verschidenen Astrologischer Objekt-Position Basis zur berechnung sind die Daten von
[http://www.astro.com/ftp/swisseph/ephe/ ](http://www.astro.com/ftp/swisseph/ephe/ )

Für Beispiele schau dir die index.php an oder die SwissEphemerisRepository.php

---

Info
---
[Swiss Ephemeris Website](https://www.astro.com/swisseph/swephinfo_e.htm)

[Swiss Ephemeris Download lib](http://www.astro.com/ftp/swisseph/)

[Swiss Ephemeris Examples Interface](https://www.astro.com/ftp/swisseph/doc/swephprg.htm)

[Swiss Ephemeris Examples](https://www.astro.com/ftp/swisseph/doc/swisseph.htm)

UPDATE 2.0.9
---
- Update to wonderful Swiss Ephemeris 2.0.8
- Extend Repository class

HELP
---
Do you want more flexibility or have you found a mistake? Open a issus

[Open Issus](https://github.com/rogergerecke/SwissEphemeris/issues)

Install via Composer Dependency Manager
---

Add to your composer.json and run composer update
```

"repositories": [
    {
      "type": "git",
      "name": "rogergerecke/swiss-ephemeris",
      "url": "https://github.com/rogergerecke/SwissEphemeris.git"
    }
  ],
  "require": {
  "rogergerecke/swiss-ephemeris": "*",
  }
  
```