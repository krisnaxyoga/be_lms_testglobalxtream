<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\lead_probabilities;
use App\Http\Resources\PostResource;

class LeadProbabilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = lead_probabilities::all();

            return new PostResource(true, 'List Data Lead Probabilities', $data);
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
            $data = lead_probabilities::create($request->all());

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
    public function show($id)
    {
        try {
            $data = lead_probabilities::find($id);

            if (!$data) {
                return response()->json([
                    'error' => 'Data not found',
                ], 404);
            }

            return new PostResource(true, 'Detail Data Lead Probabilities', $data);
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
    public function update(Request $request, $id)
    {
        try {
            $data = lead_probabilities::find($id);

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
    public function destroy($id)
    {
        try {
            $data = lead_probabilities::find($id);

            if (!$data) {
                return response()->json([
                    'error' => 'Data not found',
                ], 404);
            }

            $data->delete();

            return new PostResource(true, 'Success delete data', null);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}

