<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\lead_sources;
use App\Http\Resources\PostResource;

class LeadSourcesController extends Controller
{
    /**
     * Retrieve all the lead sources.
     */
    public function index()
    {
        try {
            $data = lead_sources::with('media')->get();
            return new PostResource(true, 'Success fetch data', $data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }

    }

    /**
     * Store a newly created lead source in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = lead_sources::create($request->all());

            return new PostResource(true, 'Success save data', $data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Retrieve a specific lead source.
     */
    public function show(string $id)
    {
        try{
            $data = lead_sources::findOrFail($id);
            return new PostResource(true, 'Success fetch data', $data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Update a specific lead source in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = lead_sources::find($id);

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
     * Remove a specific lead source from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = lead_sources::findOrFail($id);
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

