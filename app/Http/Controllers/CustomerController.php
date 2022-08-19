<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    
    public function getCustomer()
    {
        return Customer::all();
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        try {
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();
    
            return response()->json(['status' => true, 'message' => 'Customer Created !']);
            //code...
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something wrong !']);
            //throw $th;
        }

    }

    public function update(Request $request, Customer $customer)
    {
        try {
            $customer = $customer->find($request->id);
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->update();
    
            return response()->json(['status' => true, 'message' => 'Customer Updated !']);
            //code...
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something wrong !']);
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer,$id)
    {
        try {
           
            $customer = $customer->find($id)->delete();
    
            return response()->json(['status' => true, 'message' => 'Customer Deleted !']);
            //code...
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something wrong !']);
            //throw $th;
        }

    }
}
