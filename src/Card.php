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
class Card implements Location
{
    /**
     * @var string
     */
    private $fullName;
    /**
     * @var \Libreworks\Microformats\Name
     */
    private $name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $logo;
    /**
     * @var string
     */
    private $photo;
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $uid;
    /**
     * @var string
     */
    private $category;
    /**
     * @var \Libreworks\Microformats\Address
     */
    private $address;
    /**
     * @var string
     */
    private $tel;
    /**
     * @var string
     */
    private $note;
    /**
     * @var \DateTimeImmutable
     */
    private $birthday;
    /**
     * @var string
     */
    private $key;
    /**
     * @var \Libreworks\Microformats\Card
     */
    private $org;
    /**
     * @var string
     */
    private $orgName;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $role;
    /**
     * @var string
     */
    private $impp;
    /**
     * @var string
     */
    private $sex;
    /**
     * @var string
     */
    private $gender;
    /**
     * @var \DateTimeImmutable
     */
    private $anniversary;

    private static $strings = [
        'u-email' => 'email', 'u-photo' => 'photo', 'u-url' => 'url',
        'u-uid' => 'uid', 'p-category' => 'category', 'p-tel' => 'tel',
        'p-note' => 'note', 'u-key' => 'key',
        'p-organization-name' => 'orgName', 'p-job-title' => 'title',
        'p-role' => 'role', 'u-impp' => 'impp', 'p-sex' => 'sex',
        'p-gender-identity' => 'gender'
    ];
    private static $dates = [
        'dt-bday' => 'birthday', 'dt-anniversary' => 'anniversary'
    ];

    /**
     * Creates a new Card.
     *
     * The values can be any of the following:
     * ```
     * name / p-name - The full/formatted name of the person or organisation
     *                 Can either be a string or a Name object.
     * email / u-email - email address
     * logo / u-logo - a logo representing the person or organisation
     * photo / u-photo
     * url / u-url - home page
     * uid / u-uid - universally unique identifier, typically canonical URL
     * category / p-category - category/tag
     * address / p-adr - An Address object
     * tel / p-tel - telephone number
     * note / p-note - additional notes
     * birthday / dt-bday - birth date
     * key / u-key - cryptographic public key e.g. SSH or GPG
     * org / p-org - affiliated organization, either a string or Card
     *               String values overwrite the p-organization-name field
     * orgName / p-organization-name
     * title / p-job-title - job title
     * role / p-role - description of role
     * impp / u-impp per RFC4770
     * sex / p-sex - biological sex
     * gender / p-gender-identity - gender identity
     * anniversary / dt-anniversary - date of anniversary
     * ```
     *
     * @param array $values The values
     */
    public function __construct(array $values)
    {
        if (array_key_exists('p-name', $values)) {
            if ($values['p-name'] instanceof Name) {
                $this->name = $values['p-name'];
            } else {
                $this->fullName = trim($values['p-name']);
            }
        } elseif (array_key_exists('name', $values)) {
            if ($values['name'] instanceof Name) {
                $this->name = $values['name'];
            } else {
                $this->fullName = trim($values['name']);
            }
        }
        foreach (self::$strings as $mf => $p) {
            if (array_key_exists($mf, $values)) {
                $this->$p = trim($values[$mf]);
            } elseif (array_key_exists($p, $values)) {
                $this->$p = trim($values[$p]);
            }
        }
        foreach (self::$dates as $mf => $p) {
            if (array_key_exists($mf, $values)) {
                $val = $values[$mf];
                if ($val instanceof \DateTimeInterface) {
                    $this->$p = $val instanceof \DateTime ?
                        \DateTimeImmutable::createFromMutable($val) : $val;
                }
            } elseif (array_key_exists($p, $values)) {
                $val = $values[$p];
                if ($val instanceof \DateTimeInterface) {
                    $this->$p = $val instanceof \DateTime ?
                        \DateTimeImmutable::createFromMutable($val) : $val;
                }
            }
        }
        if (array_key_exists('p-adr', $values)) {
            if ($values['p-adr'] instanceof Address) {
                $this->address = $values['p-adr'];
            }
        } elseif (array_key_exists('address', $values)) {
            if ($values['address'] instanceof Address) {
                $this->address = $values['address'];
            }
        }
        if (array_key_exists('p-org', $values)) {
            if ($values['p-org'] instanceof Card) {
                $this->org = $values['p-org'];
            } else {
                $this->orgName = trim($values['p-org']);
            }
        } elseif (array_key_exists('org', $values)) {
            if ($values['org'] instanceof Card) {
                $this->org = $values['org'];
            } else {
                $this->orgName = trim($values['org']);
            }
        }
    }
    
    /**
     * Gets the full/formatted name of the person or organisation.
     *
     * @return string the full name
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Gets the name.
     *
     * @return \Libreworks\Microformats\Name the name or null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the e-mail address.
     *
     * @return string the e-mail address
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Gets a logo representing the person or organisation.
     *
     * @return string The logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Gets the photo.
     *
     * @return string The photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Gets the home page URL.
     *
     * @return string The URL
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Gets the universally unique identifier, typically canonical URL.
     *
     * @return string the universally unique identifier
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Gets the category tag.
     *
     * @return string the category/tag
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Gets the address.
     *
     * @return \Libreworks\Microformats\Address the address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Gets the telephone number.
     *
     * @return string The telephone number
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Gets additional notes.
     *
     * @return string additional notes
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Gets the birthday.
     *
     * @return \DateTimeImmutable the birthday or null
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Gets the cryptographic public key (e.g. SSH or GPG).
     *
     * @return string the cryptographic public key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Gets the affiliated organization
     *
     * @return \Libreworks\Microformats\Card the affiliated organization or null
     */
    public function getOrg()
    {
        return $this->org;
    }

    /**
     * Gets the affiliated organization name
     *
     * @return string The affiliated organization name
     */
    public function getOrgName()
    {
        return $this->orgName;
    }

    /**
     * Gets the job title
     *
     * @return string The job title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Gets the role description
     *
     * @return string The role description
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Gets the IMPP (see RFC4770)
     *
     * @return string The IMPP
     */
    public function getImpp()
    {
        return $this->impp;
    }

    /**
     * Gets the biological sex
     *
     * @return string The biological sex
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Gets the gender identity.
     *
     * @return string The gender identity
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Gets the anniversary.
     *
     * @return \DateTimeImmutable The anniversary or null
     */
    public function getAnniversary()
    {
        return $this->anniversary;
    }
    
    /**
     * Gets the geographic coordinates.
     *
     * @return \Libreworks\Microformats\Geo returns the location or null
     */
    public function getGeo()
    {
        return $this->address === null ? null : $this->address->getGeo();
    }
}
