<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;

class CustomerCOntroller extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers =  Customer::latest('id')->get();

        return $this->sendResponse(
            $customers,
            "All customers.",
            200,
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->validated());

        return $this->sendResponse(
            $customer,
            "Customer has been created successfully.",
            201,
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer =  Customer::find($id);
        return $this->sendResponse(
            $customer,
            "Single customer.",
            200,
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $customer =  Customer::find($id);
        if ($customer instanceof Customer) {
            $customer->update($request->validated());
        }

        return $this->sendResponse(
            $customer->refresh(),
            "Customer has been updated successfully.",
            201,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if ($customer instanceof Customer) {
            $customer->delete();

            return $this->sendResponse(
                $customer,
                "Customer has been deleted successfully.",
                200,
            );
        }

        return $this->sendError(
            $customer,
            "Something went Wrong.",
            404,
        );
    }
}
