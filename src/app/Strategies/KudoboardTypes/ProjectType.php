<?php

namespace App\Strategies\KudoboardTypes;

use App\Contracts\Kudoboards\CreateContract;
use App\Models\Kudoboards;

class ProjectType implements CreateContract
{
    private $kudoboard;
    public function __construct()
    {
        $this->kudoboard = new Kudoboards();
    }
    public function execute($kudoable)
    {
        $this->kudoboard->type = 'project';
        $this->kudoboard->title = "Kudo Board for {$kudoable->name} project";
        $this->kudoboard->kudoable()->associate($kudoable);
        
        $this->kudoboard->save();
    }
}