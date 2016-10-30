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
 * Turns names into HTML markup.
 *
 * @copyright 2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class NameFormatter
{
    /**
     * Formats a name.
     *
     * @param \Libreworks\Microformats\Name $name The name to format
     * @return string The HTML markup
     */
    public function format(Name $name)
    {
        $names = [
            'p-honorific-prefix' => $name->getPrefix(),
            'p-nickname' => $name->getNick(),
            'p-given-name' => $name->getGiven(),
            'p-additional-name' => $name->getMiddle(),
            'p-family-name' => $name->getSurname(),
            'p-honorific-suffix' => $name->getSuffix(),
            'p-maiden-name' => $name->getMaiden()
        ];
        $tags = [];
        foreach ($names as $k => $v) {
            if (strlen($v) > 0) {
                $tags[] = '<span class="' . $k . '">' . htmlspecialchars($v) . '</span>';
            }
        }
        $maiden = $name->getMaiden();
        if (strlen($maiden) > 0) {
            $tags[] = '(née <span class="p-maiden-name">' . htmlspecialchars($names['p-maiden-name']) . '</span>)';
        }
        return '<span class="p-name">' . implode(' ', $tags) . '</span>';
    }
}
