<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\v1\APIBaseController as APIBaseController;

// Load Model Stock
use App\Models\Api\Stock;
use Validator;

class StockController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::all();
        return $this->sendResponse($stocks->toArray(), "Stock retrived successfully.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input,[
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_category' => 'required',
            'product_price' => 'required',
            'product_qty' => 'required',
            'product_image' => 'required',
            'product_create_by' => 'required',
            'product_status' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.',$validator->errors());
        }else{
            // Insert data to table events
            $stocks = Stock::create($input);
            return $this->sendResponse($stocks->toArray(), "Stock create successfully.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stocks = Stock::find($id);

        if(is_null($stocks)){
            return $this->sendError('Stock not found.');
        }

        return $this->sendResponse($stocks->toArray(), "Stock retrived successfully.");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input,[
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_category' => 'required',
            'product_price' => 'required',
            'product_qty' => 'required',
            'product_image' => 'required',
            'product_create_by' => 'required',
            'product_status' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.',$validator->errors());
        }else{
            // ค้นหารายที่ต้องการอัพเดท
            $stocks = Stock::find($id);
           if(is_null($stocks)){
                return $this->sendError('Car not found.');
           }else{
                $stocks->product_name = $input['product_name'];
                $stocks->product_desc = $input['product_desc'];
                $stocks->product_category = $input['product_category'];
                $stocks->product_price = $input['product_price'];
                $stocks->product_qty = $input['product_qty'];
                $stocks->product_image = $input['product_image'];
                $stocks->product_create_by = $input['product_create_by'];
                $stocks->product_status = $input['product_status'];
                $stocks->save();
                return $this->sendResponse($stocks->toArray(), "Stock update successfully.");
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stocks = Stock::find($id);
        if(is_null($stocks)){
            return $this->sendError('Stock not found.');
        }else{
            $stocks->delete();
            return $this->sendResponse($id, "This data delete successfully.");
        }
    }
}
