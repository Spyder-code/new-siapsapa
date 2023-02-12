<?php

namespace App\Repositories;

use App\Models\PanitiaAgenda;

class PanitiaAgendaService extends Repository
{

    public function __construct()
    {
        $this->model = new PanitiaAgenda;
    }
}