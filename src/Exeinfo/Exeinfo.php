<?php

namespace Typomedia\Exeinfo;

use Typomedia\Exeinfo\Service\Parser;

/**
 * Class Exeinfo
 * @package Typomedia\Exeinfo
 */
class Exeinfo
{
    /**
     * @var string
     */
    public $product;

    /**
     * @var string
     */
    public $company;

    /**
     * @var string
     */
    public $comment;

    /**
     * @var string
     */
    public $copyright;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $version;

    /**
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        if (mime_content_type($filename) === 'application/x-dosexec') {
            $exeinfo = new Parser();
            $exeinfo->parse($filename);

            $this->product     = $exeinfo->get('ProductName');
            $this->company     = $exeinfo->get('CompanyName');
            $this->comment     = $exeinfo->get('Comments');
            $this->copyright   = $exeinfo->get('LegalCopyright');
            $this->description = $exeinfo->get('FileDescription');
            $this->version     = $exeinfo->get('FileVersion');
        }
    }
}
