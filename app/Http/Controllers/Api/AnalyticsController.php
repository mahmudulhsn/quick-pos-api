<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Http\Controllers\Api\ApiController;
use App\Models\Order;

class AnalyticsController extends ApiController
{
    public function analytics()
    {
        $test["totalCustomers"] = Customer::count();
        $test["totalOrder"] = Order::count();
        $test["totalSell"] = Order::sum("total");

        return $this->sendResponse(
            $test,
            "Analytics.",
            200,
        );
    }
}
