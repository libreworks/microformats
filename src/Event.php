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

use League\Period\Period;

/**
 * An event.
 *
 * @copyright 2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class Event
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $summary;
    /**
     * @var \League\Period\Period
     */
    private $date;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $category;
    /**
     * @var \Libreworks\Microformats\Location
     */
    private $location;

    /**
     * Creates a new event.
     *
     * @param string $name The name or title
     * @param string $summary The summary
     * @param \League\Period\Period $date The date range
     * @param string $description A more detailed descripton of the event
     * @param string $url The permalink
     * @param string $category The category/tag
     * @param \Libreworks\Microformats\Location $location The location
     */
    public function __construct($name, $summary = null, Period $date = null, $description = null, $url = null, $category = null, Location $location = null)
    {
        $this->name = trim($name);
        $this->summary = $summary === null ? null : trim($summary);
        $this->date = $date;
        $this->description = $description === null ? null : trim($description);
        $this->url = $url === null ? null : trim($url);
        $this->category = $category === null ? null : trim($category);
        $this->location = $location;
    }

    /**
     * Gets the name or title.
     *
     * @return string the name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the summary.
     *
     * @return string the summary
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Gets the date range.
     *
     * @return \League\Period\Period the date range or null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Gets a more detailed descripton of the event.
     *
     * @return string the detailed description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Gets the permalink for the event.
     *
     * @return string The event permalink
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Gets the event category/tag.
     *
     * @return string the category/tag
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Gets the location.
     *
     * @return \Libreworks\Microformats\Location the location or null
     */
    public function getLocation()
    {
        return $this->location;
    }
}
