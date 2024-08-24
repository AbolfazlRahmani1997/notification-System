<?php

namespace App\Repositories;


use App\Enums\SMSPanelTypeEnum;
use App\Models\SmsPanel;
use App\Repositories\Interfaces\SmsPanelRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SmsPanelRepository extends BaseRepository implements SmsPanelRepositoryInterface
{
    public function __construct(SmsPanel $model)
    {
        parent::__construct($model);
    }

    /**
     * Query For find Active Sms Panel Type By Default
     * @param SMSPanelTypeEnum $panelType
     * @param bool $is_active
     * @return $this
     */
    public function findByType(SMSPanelTypeEnum $panelType, bool $is_active = true): Model
    {
        $this->query = $this->query()->where('sms_pane_type', '=', $panelType)
            ->where('is_active', '=', $is_active);
        return $this->firstOrFail();
    }

    public function filters(array $filters = []): self
    {
        $this->query = $this->query()
            ->when($filters['is_active'], fn(Builder $query) => $query
                ->where('is_active', '=', $filters['is_active']))
            ->when($filters['name'], fn(Builder $query) => $query->where('name', 'link', '%' . $filters['name'] . '%'))
            ->when($filters['type'], fn(Builder $query) => $query->whereIn('type', $filters['type']));
        return $this;
    }

    public function deActive(int $panel_type):int
    {
      return  $this->query->where('is_active', '=', true)
            ->where('type', '=', $panel_type)
            ->update(['is_active'=> false]);
    }

}
