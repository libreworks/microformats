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
 * An address.
 *
 * @copyright 2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class Address implements Location
{
    /**
     * @var string
     */
    private $street;
    /**
     * @var string
     */
    private $extended;
    /**
     * @var string
     */
    private $pobox;
    /**
     * @var string
     */
    private $locality;
    /**
     * @var string
     */
    private $region;
    /**
     * @var string
     */
    private $postal;
    /**
     * @var string
     */
    private $country;
    /**
     * @var Geo
     */
    private $geo;

    /**
     * Creates a new address.
     *
     * @param string $street The street address
     * @param string $extended The extended address
     * @param string $pobox The post office box
     * @param string $locality The locality (city)
     * @param string $region The region (state, province)
     * @param string $postal The postal code
     * @param string $country The country
     * @param \Libreworks\Microformats\Geo $geo The geo coordinates
     */
    public function __construct($street = null, $extended = null, $pobox = null, $locality = null, $region = null, $postal = null, $country = null, Geo $geo = null)
    {
        $this->street = $street === null ? null : trim($street);
        $this->extended = $extended === null ? null : trim($extended);
        $this->pobox = $pobox === null ? null : trim($pobox);
        $this->locality = $locality === null ? null : trim($locality);
        $this->region = $region === null ? null : trim($region);
        $this->postal = $postal === null ? null : trim($postal);
        $this->country = $country === null ? null : trim($country);
        $this->geo = $geo;
    }
    
    /**
     * Gets the street address.
     *
     * @return string The street address
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Gets the extended address.
     *
     * @return string The extended address
     */
    public function getExtended()
    {
        return $this->extended;
    }

    /**
     * Gets the post office box.
     *
     * @return string The PO Box
     */
    public function getPobox()
    {
        return $this->pobox;
    }

    /**
     * Gets the locality.
     *
     * @return string The locality or null
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Gets the region.
     *
     * @return string The region or null
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Gets the postal code.
     *
     * @return string The postal code or null
     */
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * Gets the country name.
     *
     * @return string The country name or null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Gets the geographic coordinates.
     *
     * @return \Libreworks\Microformats\Geo returns the location or null
     */
    public function getGeo()
    {
        return $this->geo;
    }
}
