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
 * An address
 *
 * @copyright 2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class Name
{
    /**
     * @var string
     */
    private $prefix;
    /**
     * @var string
     */
    private $given;
    /**
     * @var string
     */
    private $middle;
    /**
     * @var string
     */
    private $surname;
    /**
     * @var string
     */
    private $suffix;
    /**
     * @var string
     */
    private $nick;
    /**
     * @var string
     */
    private $maiden;

    /**
     * Creates a new Name.
     *
     * @param string $given The given or first name
     * @param string $middle The middle name
     * @param string $surname The surname or last name
     * @param string $prefix The prefix (e.g. Mr, Mrs, or Dr)
     * @param string $suffix The suffix (e.g. Jr, III, Esq)
     * @param string $nick The nickname
     * @param string $maiden The maiden name
     */
    public function __construct($given, $middle, $surname, $prefix = null, $suffix = null, $nick = null, $maiden = null)
    {
        $this->given = trim($given);
        $this->middle = trim($middle);
        $this->surname = trim($surname);
        $this->prefix = $prefix === null ? null : trim($prefix);
        $this->suffix = $suffix === null ? null : trim($suffix);
        $this->nick = $nick === null ? null : trim($nick);
        $this->maiden = $maiden === null ? null : trim($maiden);
    }

    /**
     * Gets the prefix.
     *
     * @return string The prefix or null
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Gets the given name.
     *
     * @return string The given name
     */
    public function getGiven()
    {
        return $this->given;
    }

    /**
     * Gets the middle name.
     *
     * @return string The middle name
     */
    public function getMiddle()
    {
        return $this->middle;
    }

    /**
     * Gets the surname.
     *
     * @return string The surname
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Gets the suffix.
     *
     * @return string The suffix
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * Gets the nickname.
     *
     * @return string The nickname
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * Gets the maiden name.
     *
     * @return string The maiden name
     */
    public function getMaiden()
    {
        return $this->maiden;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return implode(
            " ",
            array_filter([
                $this->prefix,
                $this->nick === null ? null : '"' . $this->nick . '"',
                $this->given, $this->middle, $this->surname, $this->suffix,
                $this->maiden === null ? null : "(née {$this->maiden})"
            ])
        );
    }
}
