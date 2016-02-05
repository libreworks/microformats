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
 * A grouping of skills under a heading.
 *
 * @copyright 2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class SkillHeading
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var \Libreworks\Microformats\Skill[]
     */
    private $skills = [];
    
    /**
     * Creates a new SkillHeading.
     *
     * @param string $name The heading title
     * @param \Libreworks\Microformats\Skill[] $skills The skills within
     */
    public function __construct($name, array $skills = [])
    {
        $this->name = trim($name);
        foreach ($skills as $v) {
            if ($v instanceof Skill) {
                $this->skills[] = $v;
            }
        }
    }
    
    /**
     * Gets the heading title.
     *
     * @return string The heading title
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the skills under this heading.
     *
     * @return \Libreworks\Microformats\Skill[] $skills The skills within
     */
    public function getSkills()
    {
        return $this->skills;
    }
}
