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
 * A tag.
 *
 * @copyright 2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class Tag
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $url;
    
    /**
     * Creates a new Tag.
     *
     * @param string $url The tag URL
     * @param string $name The tag name
     */
    public function __construct($url, $name)
    {
        $this->url = trim($url);
        $this->name = trim($name);
    }
    
    /**
     * Gets the name.
     *
     * @return string The name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the URL.
     *
     * @return string The URL
     */
    public function getUrl()
    {
        return $this->url;
    }
}
