<?php
/**
 * This source file is subject to the MIT license that is bundled with this package in the file LICENSE.txt.
 *
 * @package   Soliant\SimpleFM\ZF2
 * @copyright Copyright (c) 2007-2015 Soliant Consulting, Inc. (http://www.soliantconsulting.com)
 * @author    jsmall@soliantconsulting.com
 */

namespace Soliant\SimpleFM\Loader;

require_once('AbstractLoader.php');

use Soliant\SimpleFM\Adapter;
use SimpleXMLElement;

class FileGetContents extends AbstractLoader
{

    /**
     * @param Adapter $adapter
     * @return SimpleXMLElement
     */
    public function load(Adapter $adapter)
    {
        $this->adapter = $adapter;

        self::prepare();

        libxml_use_internal_errors(true);
        
        $opts = array(
            'ssl'=> array(
                'verify_peer' => $this->adapter->getSslverifypeer(),
            ),
        );
        
        $context  = stream_context_create($opts);

        return simplexml_load_string(file_get_contents($this->commandURL, false, $context));

    }
}
