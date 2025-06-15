<?php

namespace App\Services;

use App\Models\Cluster;

class ClusterService
{

    protected $cluster;

    public function __construct(Cluster $cluster)
    {
        $this->cluster = $cluster;
    }

    public function getClusterByIteration($iteration)
    {
        return $this->cluster->where('iteration', $iteration)->get();
    }

    public function getClusterNameByIterationAndCode($iteration, $code)
    {
        return $this->cluster->where('iteration', $iteration)->where('cluster_code', $code)->pluck('cluster_name')->first();
    }

}
