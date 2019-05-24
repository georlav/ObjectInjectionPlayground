<?php
namespace Components;

/*
 * PHP Class with an exploitable __wakeup method
 * Payload example Information disclosure via function injection
 * O:19:"Components\Evaluate":1:{s:5:"param";s:7:"phpinfo";}
 *
 */
class Evaluate
{
    public $param;

    public function __wakeup()
    {
        if (isset($this->param)) {
            call_user_func($this->param);
        }
    }
}