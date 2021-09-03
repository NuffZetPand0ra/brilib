<?php
namespace nuffy\BriLib\Bridge;

use Closure;
use Iterator;
use Doctrine\Common\Collections\{AbstractLazyCollection, ArrayCollection};
use Exception;
use nuffy\BriLib\Bridge\Board;

class BoardCollection extends ArrayCollection
{
    /**
     * 
     * @param Board $element 
     * @return true 
     * @throws Exception 
     */
    public function add($element)
    {
        if(!$element instanceof Board) throw new \Exception("Board collections can only contain Board objs");
        return parent::add($element);
    }
}