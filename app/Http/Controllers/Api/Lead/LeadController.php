<?php

namespace App\Http\Controllers\Api\Lead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\leads;
use App\Http\Resources\PostResource;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = leads::with('lead_status', 'lead_probability', 'type', 'channel', 'media', 'source');

            if ($request->has('searchText') && !empty($request->searchText)) {
                $query->where(function ($q) use ($request) {
                    $q->where('fullname', 'like', '%' . $request->searchText . '%')
                        ->orWhere('lead_number', 'like', '%' . $request->searchText . '%');
                });
            }

            if ($request->has('dateFrom') && !empty($request->dateFrom)) {
                $query->whereDate('created_at', '>=', $request->dateFrom);
            }

            if ($request->has('dateTo') && !empty($request->dateTo)) {
                $query->whereDate('created_at', '<=', $request->dateTo);
            }

            if ($request->has('status') && !empty($request->status)) {
                $query->whereHas('lead_status', function ($q) use ($request) {
                    $q->where('name', $request->status);
                });
            }

            if ($request->has('branchOffice') && !empty($request->branchOffice)) {
                $query->where('branch_office', $request->branchOffice);
            }

            $data = $query->get();

            return new PostResource(true, 'List Data User', $data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $input['lead_number'] = $input['lead_number'] ?? 'LD' . substr(str_shuffle("0123456789"), 0, 9);
            $data = leads::create($input);

            return new PostResource(true, 'Data Added Successfully', $data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = leads::with('lead_status', 'lead_probability', 'type', 'channel', 'media', 'source')->find($id);

            return new PostResource(true, 'Data Detail', $data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'branch_office' => 'string|nullable',
                'fullname' => 'string|nullable',
                'email' => 'string|nullable',
                'phone' => 'string|nullable',
                'address' => 'string|nullable',
                'status' => 'integer|nullable',
                'probability' => 'integer|nullable',
                'lead_type' => 'integer|nullable',
                'lead_channel' => 'integer|nullable',
                'lead_media' => 'integer|nullable',
                'lead_source' => 'integer|nullable',
                'general_notes' => 'string|nullable',
            ]);

            $data = leads::where('id', $id)->update($validatedData);

            return new PostResource(true, 'Data Updated Successfully', $data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = leads::find($id)->delete();

            return new PostResource(true, 'Data Deleted Successfully', $data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
