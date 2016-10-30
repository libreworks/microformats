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
 * Turns geo coordinates into HTML markup.
 *
 * @copyright 2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class GeoFormatter
{
    /**
     * Formats a geo.
     *
     * @param \Libreworks\Microformats\Geo $geo The geo coordinates
     * @return string The HTML markup
     */
    public function format(Geo $geo)
    {
        return '<span class="h-geo">'
            . '<span class="p-latitude">' . (string)$geo->getLatitude() . '</span>, '
            . '<span class="p-longitude">' . (string)$geo->getLongitude() . '</span>'
            . ($geo->getAltitude() === null ? '' : ' (elevation <span class="p-altitude">' . (string)$geo->getAltitude() . '</span>)')
            . '</span>';
    }
}
