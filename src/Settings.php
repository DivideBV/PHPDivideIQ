<?php namespace DivideBV\PHPDivideIQ;

/**
 * This file is part of PHPDivideIQ.
 *
 * PHPDivideIQ is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * PHPDivideIQ is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PHPDivideIQ.  If not, see <http://www.gnu.org/licenses/>.
 */

class Settings implements \JsonSerializable
{
    /**
     * An array of the services this account has access to.
     *
     * @var string[]
     */
    protected $services;

    /**
     * The updated date of this revision of the settings.
     *
     * @var int
     */
    protected $updated;

    /**
     * Creates an object to represent Divide.IQ account settings.
     *
     * @param string[] $services
     *     An array of services.
     * @param int $updated
     *     The updated timestamp.
     */
    public function __construct(array $services, $updated)
    {
        $this->services = $services;
        $this->updated = $updated;
    }

    /**
     * Gets the path of a service.
     *
     * @param string $serviceName
     *
     * @return string
     */
    public function getPath($serviceName)
    {
        if (in_array($serviceName, $this->services)) {
            return str_replace('_', '/', $serviceName);
        } else {
            $services = implode(', ', $this->services);
            throw new \Exception("Service \"{$serviceName}\" is not one of: {$services}");
        }
    }

    /**
     * Checks whether the settings are outdated.
     *
     * @param int $last_updated
     *     Timestamp the settings were last updated.
     *
     * @return bool
     */
    public function isOutdated($last_update)
    {
        return ($this->updated != $last_update);
    }

    /**
     * Serializes the object using JSON.
     *
     * @return string
     *     The JSON representation of the object.
     */
    public function toJson()
    {
        return json_encode($this);
    }

    /**
     * Unserializes the object from JSON.
     *
     * @param string $json
     *     The object as serialized using JSON.
     *
     * @return Settings
     *     The unserialized object.
     */
    public static function fromJson($json)
    {
        $data = json_decode($json);

        // Recreate the object.
        return new static($data->services, $data->updated);
    }

    /**
     * Implements \JsonSerializable::jsonSerialize.
     */
    public function jsonSerialize()
    {
        return [
            'services' => $this->services,
            'updated' => $this->updated,
        ];
    }
}
