<?php

namespace App\Domain\Services\BaseServices;

use App\Models\Client;
use App\Models\ConsultingCompany;
use App\Models\Engineer;
use App\Models\Owner;
use App\Models\Project;
use App\Models\ProjectManager;
use App\Models\ProjectSalesDetails;
use App\Models\PropertyUnitOrder;

class ReportsService
{
    public function getCounts(): array
    {
        return [
            'consulting_companies'   => ConsultingCompany::count(),
            'owners'                 => Owner::count(),
            'projects'               => Project::count(),
            'engineers'              => Engineer::count(),
            'project_managers'       => ProjectManager::count(),
            'clients'                => Client::count(),
            'project_sales_details'  => ProjectSalesDetails::count(),
            'property_unit_orders'   => PropertyUnitOrder::count(),
        ];
    }
}
