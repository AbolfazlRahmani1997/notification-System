<?php

namespace App\Services\Interfaces;

use App\Models\SmsPanel;

interface SmsPanelServiceInterface
{

    public function find(int $id): SmsPanel;

    public function create(array $data): SmsPanel;

}
