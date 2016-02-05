<?php
/**
 * Microformats
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 *
 * @copyright 2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
namespace Libreworks\Microformats;

/**
 * A geo point
 *
 * @copyright 2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class Geo implements Location
{
    /**
     * @var float
     */
    private $latitude;
    /**
     * @var float
     */
    private $longitude;
    /**
     * @var float
     */
    private $altitude;

    const DEG_KM = 111.13384;
    
    /**
     * Creates a new Geo point.
     *
     * @param float $latitude The latitude
     * @param float $longitude The longitude
     * @param float $altitude The altitude (presumably in meters) or null
     */
    public function __construct($latitude, $longitude, $altitude = null)
    {
        $this->latitude = (float)$latitude;
        $this->longitude = (float)$longitude;
        $this->altitude = $altitude === null ? null : (float)$altitude;
    }

    /**
     * Gets the latitude.
     *
     * @return float The latitude
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Gets the longitude.
     *
     * @return float The longitude
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Gets the altitude.
     *
     * @return float The altitude or null
     */
    public function getAltitude()
    {
        return $this->altitude;
    }
    
    /**
     * Uses the Haversine formula to calculate kilometer point distance.
     *
     * @param \Libreworks\Microformats\Geo $other
     * @return float The distance
     */
    public function distance(Geo $other)
    {
        if ($other === $this) {
            return 0.0;
        } else {
            return self::DEG_KM * rad2deg(
                acos(
                    (sin(deg2rad($this->latitude)) * sin(deg2rad($other->latitude))) +
                    (cos(deg2rad($this->latitude)) * cos(deg2rad($other->latitude)) * cos(deg2rad($this->longitude - $other->longitude)))
                )
            );
        }
    }

    /**
     * Gets the geographic coordinates.
     *
     * @return \Libreworks\Microformats\Geo returns the location or null
     */
    public function getGeo()
    {
        return $this;
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
        return "geo:{$this->latitude},{$this->longitude}" .
            ($this->altitude === null ? '' : ",$this->altitude");
    }
}
