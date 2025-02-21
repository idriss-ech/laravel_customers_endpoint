<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MOdels\Customer;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if($request->has('filter'))
        {
            foreach($request->filter as $key => $value){
                $query->where($key, 'like', "%$value%");
            }
        }

        if($request->has('sort')){
            foreach($request->sort as $key => $direction){
                $query->orderBy($key, $direction);
            }
        }

        $customers = $query->paginate(
            $request->input('page.size',10),
            ['*'],
            'page[number]',
            $request->input('page.number',1)
        );

        return response()->json($customers, 200, ['X-API-Version' => 'v1']);
    }
}
