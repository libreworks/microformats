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
 * Turns addresses into HTML markup.
 *
 * @copyright 2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class AddressFormatter
{
    /**
     * @var \Libreworks\Microformats\GeoFormatter
     */
    private $geoFormatter;
    
    /**
     * Creates a new AddressFormatter.
     *
     * @param \Libreworks\Microformats\GeoFormatter $geoFormatter The geo formatter
     */
    public function __construct(GeoFormatter $geoFormatter = null)
    {
        $this->geoFormatter = $geoFormatter === null ? new GeoFormatter() : $geoFormatter;
    }

    /**
     * Formats an address.
     *
     * @param \Libreworks\Microformats\Address $address
     * @return string The HTML markup
     */
    public function format(Address $address)
    {
        $fields = [
            'p-street-address' => $address->getStreet(),
            'p-extended-address' => $address->getExtended(),
            'p-post-office-box' => $address->getPobox(),
            'p-locality' => $address->getLocality(),
            'p-region' => $address->getRegion(),
            'p-postal-code' => $address->getPostal(),
            'p-country' => $address->getCountry()
        ];
        $tags = [];
        foreach ($fields as $k => $v) {
            if (strlen($v) > 0) {
                $tags[] = '<span class="' . $k . '">' . htmlspecialchars($v) . '</span>';
            }
        }
        $geo = $address->getGeo();
        if ($geo !== null) {
            $tags[] = '<span class="p-geo">' . $this->geoFormatter->format($geo) . '</span>';
        }
        return '<span class="h-adr">' . implode(' ', $fields) . '</span>';
    }
}
