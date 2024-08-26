<?php

namespace App\Services;

use App\Models\SmsPanel;
use App\Repositories\Interfaces\SmsPanelRepositoryInterface;
use App\Services\Interfaces\SmsPanelServiceInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class SmsPanelService implements SmsPanelServiceInterface
{
    public function __construct(private SmsPanelRepositoryInterface $repository)
    {
    }

    public function find(int $id): SmsPanel
    {
        /** @var SmsPanel $smsPanel */
        $smsPanel = $this->repository->filterById($id)->firstOrFail();
        return $smsPanel;
    }


    public function create(array $data): SmsPanel
    {

        $result = DB::transaction(function () use ($data) {
            $this->repository->deActive($data['sms_panel_type']);
            return $this->repository->store($data);
        });
        return $result;

    }
}
