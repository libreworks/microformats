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
 * A resume skill.
 *
 * @copyright 2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class Skill
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var \Libreworks\Microformats\Tag
     */
    private $tag;
    /**
     * @var int
     */
    private $rating;
    /**
     * @var \League\Period\Period[]
     */
    private $dates = [];

    /**
     * Creates a new skill.
     *
     * @param \Libreworks\Microformats\Tag|string $name The name of the skill
     * @param int $rating Level of expertise, 1–4 (beginner, intermediate, advanced, expert)
     * @param \League\Period\Period[] $dates The range of dates
     */
    public function __construct($name, $rating = null, array $dates = [])
    {
        if ($name instanceof Tag) {
            $this->tag = $name;
        } elseif ($name !== null) {
            $this->name = trim($name);
        }
        $this->rating = $rating === null ? null : (int)$rating;
        foreach ($dates as $v) {
            if ($v instanceof Period) {
                $this->dates[] = $v;
            }
        }
    }

    /**
     * Gets the name.
     *
     * @return string The name
     */
    public function getName()
    {
        return $this->tag === null ? $this->name : $this->tag->getName();
    }

    /**
     * Gets the tag.
     *
     * @return \Libreworks\Microformats\Tag the tag or null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Gets the skill rating.
     *
     * @return int The rating
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Gets the dates.
     *
     * @return \League\Period\Period[] the dates
     */
    public function getDates()
    {
        return $this->dates;
    }
}
