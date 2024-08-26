<?php

namespace App\Services;

use App\Repositories\Interfaces\TemplateRepositoryInterface;
use App\Services\Interfaces\TemplateServiceInterface;

class TemplateService implements TemplateServiceInterface
{

    public function __construct(private TemplateRepositoryInterface $repository)
    {
    }


    public function store(array $data)
    {
        $template = $this->repository->store($data);
        return $template;

    }

    public function show(int $id)
    {
        $template = $this->repository->filterById($id);
        return $template;
    }

    public function index(array $filters)
    {
        return $this->repository->filters($filters)->getAll();

    }

    public function update(int $id, array $data)
    {

    }

}
