<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface TemplateRepositoryInterface extends BaseRepositoryInterface
{

    public function filterByProvider(int $provider): self;

    public function filterByTitle(string $title): self;

    public function filters(array $filter): self;


}
