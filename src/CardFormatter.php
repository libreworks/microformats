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
class CardFormatter
{
    /**
     * @var \Libreworks\Microformats\AddressFormatter
     */
    private $addressFormatter;
    /**
     * @var \Libreworks\Microformats\NameFormatter
     */
    private $nameFormatter;
    
    /**
     * Creates a new CardFormatter.
     *
     * @param \Libreworks\Microformats\AddressFormatter $addressFormatter
     * @param \Libreworks\Microformats\NameFormatter $nameFormatter
     */
    public function __construct(AddressFormatter $addressFormatter = null, NameFormatter $nameFormatter = null)
    {
        $this->addressFormatter = $addressFormatter === null ? new AddressFormatter() : $addressFormatter;
        $this->nameFormatter = $nameFormatter === null ? new NameFormatter() : $nameFormatter;
    }

    /**
     * Formats a card.
     *
     * @param \Libreworks\Microformats\Card $card The card to format
     * @return string The HTML markup
     */
    public function format(Card $card)
    {
        $tags = [];
        
        $name = $card->getName();
        $fullName = $card->getFullName();
        if ($name !== null) {
            $tags[] = '<dt>Name</dt><dd><span class="p-name">' . $this->nameFormatter->format($name) . '</span></dd>';
        } elseif (strlen($fullName) > 0) {
            $tags[] = '<dt>Name</dt><dd><span class="p-name">' . htmlspecialchars($fullName) . '</span></dd>';
        }
        
        $photo = $card->getPhoto();
        if ($photo !== null) {
            $tags[] = '<dt>Photo</dt><dd><img class="u-photo" src="' . htmlspecialchars($photo) . '" alt="Photo" /></dd></span>';
        }
        $logo = $card->getLogo();
        if ($logo !== null) {
            $tags[] = '<dt>Logo</dt><dd><img class="u-logo" src="' . htmlspecialchars($logo) . '" alt="Logo" /></dd></span>';
        }
        
        $address = $card->getAddress();
        if ($address !== null) {
            $tags[] = '<dt>Address</dt><dd class="p-adr">' . $this->addressFormatter->format($address) . '</dd>';
        }
        
        $tel = $card->getTel();
        if (strlen($tel) > 0) {
            $tags[] = '<dt>Phone</dt><dd><a href="tel:' . preg_replace('/[^0-9\+]/', '', $tel) . '" class="p-tel">' . htmlspecialchars($tel) .  '</a></dd>';
        }
        
        $email = $card->getEmail();
        if (strlen($email) > 0) {
            $tags[] = '<dt>Email</dt><dd><a href="mailto:' . htmlspecialchars($email) . '" class="u-email">' . htmlspecialchars($email) . '</a></dd>';
        }

        $url = $card->getUrl();
        if (strlen($url) > 0) {
            $tags[] = '<dt>Homepage</dt><dd><a href="' . htmlspecialchars($url) . '" class="u-url>' . htmlspecialchars($url) . '</a></dd>';
        }
        
        $impp = $card->getImpp();
        if (strlen($impp) > 0) {
            $tags[] = '<dt>IMPP</dt><dd><a href="' . htmlspecialchars($impp) . '" class="u-impp">' . htmlspecialchars($impp) . '</a></dd>';
        }
        
        $org = $card->getOrg();
        $orgName = $card->getOrgName();
        if ($org !== null) {
            $tags[] = '<dt>Organization</dt><dd class="p-org">' . $this->format($org) . '</dd>';
        } elseif (strlen($orgName) > 0) {
            $tags[] = '<dt>Organization</dt><dd><span class="p-org p-organization-name">' . htmlspecialchars($orgName) . '</span></dd>';
        }
        
        $title = $card->getTitle();
        if (strlen($title) > 0) {
            $tags[] = '<dt>Title</dt><dd><span class="p-job-title">' . htmlspecialchars($title) . '</span></dd>';
        }
        
        $role = $card->getRole();
        if (strlen($role) > 0) {
            $tags[] = '<dt>Role</dt><dd><span class="p-role">' . htmlspecialchars($role) . '</span></dd>';
        }
        
        $sex = $card->getSex();
        if (strlen($sex) > 0) {
            $tags[] = '<dt>Sex</dt><dd><span class="p-sex">' . htmlspecialchars($role) . '</span></dd>';
        }
        
        $gender = $card->getGender();
        if (strlen($gender) > 0) {
            $tags[] = '<dt>Gender</dt><dd><span class="p-gender">' . htmlspecialchars($gender) . '</span></dd>';
        }
        
        $birthday = $card->getBirthday();
        if ($birthday !== null) {
            $tags[] = '<dt>Birthday</dt><dd><time class="dt-bday" datetime="' . $birthday->format('Y-m-d') . '">' . $birthday->format('F j, Y') . '</time></dd>';
        }
        
        $anniversary = $card->getAnniversary();
        if ($anniversary !== null) {
            $tags[] = '<dt>Anniversary</dt><dd><time class="dt-anniversary" datetime="' . $anniversary->format('Y-m-d') . '">' . $anniversary->format('F j, Y') . '</time></dd>';
        }
        
        $key = $card->getKey();
        if (strlen($key) > 0) {
            $tags[] = '<dt>Public Key</dt><dd><span class="u-key">' . htmlspecialchars($key) . '</span></dd>';
        }

        $category = $card->getCategory();
        if (strlen($category) > 0) {
            $tags[] = '<dt>Category</dt><dd><span class="p-category">' . htmlspecialchars($category) . '</span></dd>';
        }
        
        $note = $card->getNote();
        if (strlen($note) > 0) {
            $tags[] = '<dt>Note</dt><dd><div class="p-note">' . htmlspecialchars($note) . '</div></dd>';
        }

        return '<dl class="h-card">' . implode(' ', $tags) . '</dl>';
    }
}
