<?php

namespace App\Repositories;

use App\Models\Template;
use App\Repositories\Interfaces\TemplateRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TemplateRepository extends BaseRepository implements TemplateRepositoryInterface
{
    public function __construct(Template $model)
    {
        parent::__construct($model);
    }

    public function filterByProvider(int $provider): self
    {
        $this->query = $this->query()->where('provider', '=', $provider);
        return $this;
    }

    public function filters(array $filter): self
    {
        return $this;
    }

    public function filterByTitle(string $title): self
    {
        $this->query = $this->query()->where('template_name', '=', $title);
        return $this;
    }
}
