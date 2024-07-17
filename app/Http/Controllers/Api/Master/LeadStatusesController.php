<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\lead_statuses;
use App\Http\Resources\PostResource;

class LeadStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = lead_statuses::all();
            return new PostResource(true, 'Success fetch data', $data);
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
            $data = lead_statuses::create($request->all());

            return new PostResource(true, 'Success save data', $data);
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
            $data = lead_statuses::findOrFail($id);
            if (!$data) {
                return response()->json([
                    'error' => 'Data not found',
                ], 404);
            }
            return new PostResource(true, 'Success save data', $data);
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
            $data = lead_statuses::find($id);

            if (!$data) {
                return response()->json([
                    'error' => 'Data not found',
                ], 404);
            }

            $data->update($request->all());

            return new PostResource(true, 'Success update data', $data);
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
            $data = lead_statuses::findOrFail($id);
            $data->delete();

            return new PostResource(true, 'Data Deleted Successfully', null);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
