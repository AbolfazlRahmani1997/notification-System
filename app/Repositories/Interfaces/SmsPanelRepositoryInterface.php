<?php

namespace App\Repositories\Interfaces;


use App\Enums\SMSPanelTypeEnum;
use Illuminate\Database\Eloquent\Model;

interface SmsPanelRepositoryInterface extends BaseRepositoryInterface
{
    public function findByType(SMSPanelTypeEnum $panelType, bool $is_active = true): Model;

    public function deActive(int $panel_type): int;

    public function filters(array $filters = []): self;

}
