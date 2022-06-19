<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Citizen\IndexRequest;
use App\Http\Requests\Citizen\StoreRequest;
use App\Http\Requests\Citizen\UpdateRequest;
use App\Http\Resources\CitizenCollection;
use App\Models\Citizen;
use App\Models\Company;
use App\Models\CitizenCompany;

class CitizenController extends Controller
{

    public function index(IndexRequest $request)
    {
        $filter_fields = ['full_name' => ['type' => 'string'],'passport' => ['type' => 'string']];
        $params = $request->validated();

        if($params) 
        {
            foreach ($filter_fields as $key => $item) 
            {
                if (array_key_exists($key, $params)) 
                {
                    if ($item['type'] == 'string')
                        $query = Citizen::where($key, 'like', '%' . $params[$key] . '%');

                    if ($item['type'] == 'number' && $params[$key] != "")
                        $query = Citizen::where($key, $params[$key]);
                }
            }
            return new CitizenCollection($query->get());
        }

        return new CitizenCollection(Citizen::paginate());
       
    }

    public function store(StoreRequest $request)
    {
        $params = $request->validated();

        $citizen = Citizen::UpdateOrCreate(
            [
                'passport' => $params['passport'],
            ],
            [
                'full_name' => $params['full_name'],
                'birth_date' => $params['birth_date']
            ]);

        if ($params['company_id'])
        {
            $company = Company::where('id', $params['company_id'])->first();

            if ($company)
            {
                CitizenCompany::create([
                    'citizen_id' => $citizen ? $citizen->id : 0,
                    'company_id' => $company ? $company->id : 0,
                    'start_date' => $params['start_date'],
                    'end_date' => $params['end_date'],
                ]);

            }
        }

        if ($citizen) {
            return response()->json([
                'status' => 'success',
                'data' => $citizen
            ]);
        }

        return response()->json([
            'status' => 'error',
            'data' => "Unable to create Citizen"
        ], 500);
    }

    public function show($id)
    {
        if (!Citizen::find($id)) {
            return response()->json([
                'status' => 'error',
                'data' => "Citizen not found"
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => Citizen::find($id)
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        if (!Citizen::find($id)) {
            return response()->json([
                'status' => 'error',
                'data' => 'Citizen not found'
            ], 404);
        }

        $team = Citizen::find($id);

        $data = $request->validated();


        if ($team->update($data)) {
            return response()->json([
                'status' => 'success',
                'data' => "Citizen updated successfully"
            ]);
        }

        return response()->json([
            'status' => 'error',
            'data' => "Unable to update Citizen"
        ], 500);
    }

    public function destroy($id)
    {
        if (!Citizen::find($id)) {
            return response()->json([
                'status' => 'error',
                'data' => "Citizen not found"
            ], 404);
        }

        $team = Citizen::find($id);

        if ($team->delete()) {
            return response()->json([
                'status' => 'success',
                'data' => "Citizen deleted successfully"
            ]);
        }

        return response()->json([
            'status' => 'error',
            'data' => "Unable to delete Citizen "
        ], 500);
    }
}
