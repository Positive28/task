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
use Illuminate\Http\Request;

class CitizenController extends Controller
{
    public function index(IndexRequest $request)
    {
        // $params = $request->validated();

        // $condition = [];
        // $passport = request('passport', false);
        // if ($passport) {
        //     $condition['citizens.passport'] = $passport;
        // }

        // $citizens = Citizen::with('citizen_companies.company')
        //     ->where($condition)->paginate(10);

//        if ($params)
//        {
//            $items = Citizen::where('full_name', 'like', "%$params[full_name]%")->paginate(10);
//        }else {
//            $items = Citizen::orderBy('created_at', 'DESC')->paginate(10);
//        }

return new CitizenCollection(Citizen::paginate());
        return response()->json([
            'status' => 'success',
            'data' => $citizens
        ]);
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
