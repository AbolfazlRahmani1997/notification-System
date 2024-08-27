<?php

namespace App\Services\Interfaces;

use App\Models\Template;

interface TemplateServiceInterface
{

    public function show(int $id):Template;
    public function store(array $data);
    public function update(int $id,array $data);
    public function index(array $filters);

}
