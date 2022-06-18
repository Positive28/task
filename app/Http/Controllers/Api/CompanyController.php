<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\IndexRequest;
use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index(IndexRequest $request)
    {
        $params = $request->validated();
        if ($params)
        {
            $items = Company::where('company_name', 'like', "%$params[company_name]%")->paginate();
        }else {
            $items = Company::orderBy('id', 'DESC')->paginate(10);
        }

        return response()->json([
            'status' => 'success',
            'data' => $items
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        if ($item = Company::create($data)) {
            return response()->json([
                'status' => 'success',
                'data' => "Company created successfully"
            ]);
        }

        return response()->json([
            'status' => 'error',
            'data' => "Unable to create Company"
        ], 500);
    }

    public function show($id)
    {
        if (!Company::find($id)) {
            return response()->json([
                'status' => 'error',
                'data' => "Company not found"
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => Company::find($id)
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        if (!Company::find($id)) {
            return response()->json([
                'status' => 'error',
                'data' => 'Company not found'
            ], 404);
        }

        $team = Company::find($id);

        $data = $request->validated();


        if ($team->update($data)) {
            return response()->json([
                'status' => 'success',
                'data' => "Company updated successfully"
            ]);
        }

        return response()->json([
            'status' => 'error',
            'data' => "Unable to update Company"
        ], 500);
    }

    public function destroy($id)
    {
        if (!Company::find($id)) {
            return response()->json([
                'status' => 'error',
                'data' => "Company not found"
            ], 404);
        }

        $team = Company::find($id);

        if ($team->delete()) {
            return response()->json([
                'status' => 'success',
                'data' => "Company deleted successfully"
            ]);
        }

        return response()->json([
            'status' => 'error',
            'data' => "Unable to delete Company "
        ], 500);
    }
}
