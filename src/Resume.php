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
 * A resume.
 *
 * @copyright 2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class Resume
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
     * @var \Libreworks\Microformats\Card
     */
    private $contact;
    /**
     * @var \Libreworks\Microformats\Event[]
     */
    private $education = [];
    /**
     * @var \Libreworks\Microformats\Event[]
     */
    private $experience = [];
    /**
     * @var \Libreworks\Microformats\Event[]
     */
    private $volunteering = [];
    /**
     * @var \Libreworks\Microformats\SkillHeading[]
     */
    private $skills = [];
    
    /**
     * Creates a new Resume.
     *
     * @param string $name Brief name of the resume
     * @param string $summary Overview of qualifications and objectives
     * @param \Libreworks\Microformats\Card $contact Current contact info
     * @param \Libreworks\Microformats\Event[] $education Education events
     * @param \Libreworks\Microformats\Event[] $experience Experience events
     * @param \Libreworks\Microformats\Event[] $volunteering Volunteering events
     * @param \Libreworks\Microformats\SkillHeading[] $skills Skills
     */
    public function __construct($name, $summary = null, Card $contact = null, array $education = [], array $experience = [], array $volunteering = [], array $skills = [])
    {
        $this->name = trim($name);
        $this->summary = $summary === null ? null : trim($summary);
        if ($contact !== null) {
            $this->contact = $contact;
        }
        foreach ($education as $v) {
            if ($v instanceof Event) {
                $this->education[] = $v;
            }
        }
        foreach ($experience as $v) {
            if ($v instanceof Event) {
                $this->experience[] = $v;
            }
        }
        foreach ($volunteering as $v) {
            if ($v instanceof Event) {
                $this->volunteering[] = $v;
            }
        }
        foreach ($skills as $v) {
            if ($v instanceof SkillHeading) {
                $this->skills[] = $v;
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
     * Gets the contact info.
     *
     * @return \Libreworks\Microformats\Card the contact info
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Gets the education events.
     *
     * @return \Libreworks\Microformats\Event[] the education events
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * Gets the volunteering events.
     *
     * @return \Libreworks\Microformats\Event[] the volunteering events
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Gets the volunteering events.
     *
     * @return \Libreworks\Microformats\Event[] the volunteering events
     */
    public function getVolunteering()
    {
        return $this->volunteering;
    }
    
    /**
     * Gets the skill headings.
     *
     * @return \Libreworks\Microformats\SkillHeading[] the skill headings
     */
    public function getSkillHeadings()
    {
        return $this->skills;
    }
}
