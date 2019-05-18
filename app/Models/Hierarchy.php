<?php

namespace App\Models;

use App\Interfaces\HierarchyInterface;
use Franzose\ClosureTable\Models\ClosureTable;

class Hierarchy extends ClosureTable implements HierarchyInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hierarchies';
}
