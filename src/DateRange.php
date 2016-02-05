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
 * A date range
 *
 * @copyright 2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class DateRange
{
    /**
     * @var \DateTimeImmutable
     */
    private $from;
    /**
     * @var \DateTimeImmutable
     */
    private $to;
    /**
     * @var \DateInterval
     */
    private $interval;

    /**
     * Creates a new DateRange.
     *
     * @param \DateTimeInterface $from The begin date
     * @param \DateTimeInterface $to The end date
     */
    public function __construct(\DateTimeInterface $from, \DateTimeInterface $to)
    {
        $this->from = min($from, $to);
        if ($this->from instanceof \DateTime) {
            $this->from = \DateTimeImmutable::createFromMutable($this->from);
        }
        $this->to = max($from, $to);
        if ($this->to instanceof \DateTime) {
            $this->to = \DateTimeImmutable::createFromMutable($this->to);
        }
        $this->interval = date_diff($this->from, $this->to);
    }

    /**
     * Combines this date range with another one, returning the combined range.
     *
     * The date ranges must intersect.
     *
     * @param \Libreworks\Microformats\DateRange $other The date range to add
     * @return \Libreworks\Microformats\DateRange The combined range
     * @throws \InvalidArgumentException if the date ranges do not intersect
     */
    public function combine(DateRange $other)
    {
        if (!$this->intersects($other)) {
            throw new \InvalidArgumentException("Cannot combine date ranges that do not intersect");
        }
        return new DateRange(min($this->from, $other->from), max($this->to, $other->to));
    }

    /**
     * Determines if a given date is within this range.
     *
     * @param \DateTimeInterface $date The date to test
     * @return bool Whether the date is in this range
     */
    public function contains(\DateTimeInterface $date)
    {
        return $this->from <= $date && $this->to >= $date;
    }
    
    /**
     * Gets the start date of this range.
     *
     * @return \DateTimeImmutable The beginning date
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Gets the end date of this range.
     *
     * @return \DateTimeImmutable The ending date
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Gets the interval between the start and end dates.
     *
     * @return \DateInterval The interval of this range
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * If the two date ranges intersect.
     *
     * @param \Libreworks\Microformats\DateRange $other
     * @return bool Whether the two ranges intersect
     */
    public function intersects(DateRange $other)
    {
        return $other === $this ||
            ($other->from <= $this->to && $other->to >= $this->from);
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->from->format(\DateTime::ISO8601) . '–' .
            $this->to->format(\DateTime::ISO8601);
    }
}
