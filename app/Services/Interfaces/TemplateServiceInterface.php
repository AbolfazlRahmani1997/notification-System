<?php

namespace App\Services\Interfaces;

interface TemplateServiceInterface
{

    public function show(int $id);
    public function store(array $data);
    public function update(int $id,array $data);
    public function index(array $filters);

}
