<?php

namespace Typomedia\Exeinfo\Service;

/**
 * Class Parser
 * @package Typomedia\Exeinfo\Parser
 */
class Parser
{
    /**
     * @var string
     */
    private $properties;

    /**
     * @var bool
     */
    protected $error;

    /**
     * @param string $filename
     * @return string|null
     */
    public function parse(string $filename)
    {
        $handle = fopen($filename, 'rb');

        $header = fread($handle, 64);
        $offset = unpack("V", substr($header, 60, 4));
        fseek($handle, $offset[1], SEEK_SET);

        $header = fread($handle, 24);
        $offset = unpack("v", substr($header, 20, 2));
        fseek($handle, $offset[1], SEEK_CUR);

        $sections = unpack("v", substr($header, 6, 2));
        $haystack = [];
        $hasResource = false;
        for ($i = 0; $i < $sections[1]; $i++) {
            $haystack = fread($handle, 40);
            $hasResource = strpos($haystack, '.rsrc') === 0;

            if ($hasResource) {
                break;
            }
        }

        if (!$hasResource) {
            throw new \RuntimeException($filename . ' has no resource!');
        }

        $offset = unpack("V", substr($haystack, 20, 4));
        fseek($handle, $offset[1], SEEK_SET);

        $length = unpack("V", substr($haystack, 16, 4));
        $this->properties = fread($handle, $length[1]);

        return $this->properties;
    }

    /**
     * @param string $property
     * @return false|string
     */
    public function get(string $property)
    {
        $NumNamedDirs = unpack("v", substr($this->properties, 12, 2));
        $NumDirs = unpack("v", substr($this->properties, 14, 2));

        for ($i = 0; $i < ($NumDirs[1] + $NumNamedDirs[1]); $i++) {
            $type = unpack("V", substr($this->properties, ($i * 8) + 16, 4));
            if ($type[1] === 16) {
                $this->error = false;
                break;
            }
        }

        if ($this->error) {
            throw new \RuntimeException('File has no properties!');
        }

        $needle = implode("\x00", str_split($property));
        $position = strpos($this->properties, $needle);
        if ($position) {
            $string = substr($this->properties, $position);
            $result = explode("\x00\x00\x00", $string);

            return str_replace("\0", '', $result[1]);
        }
        return false;
    }
}
