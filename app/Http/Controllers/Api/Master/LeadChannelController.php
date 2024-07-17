<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\lead_channels;
use App\Http\Resources\PostResource;

class LeadChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = lead_channels::all();

            return new PostResource(true, 'List Data lead channels', $data);
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
            $lead_channel = lead_channels::create($request->all());

            return new PostResource(true, 'Data Added Successfully', $lead_channel);
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
            $data = lead_channels::findOrFail($id);
            if (!$data) {
                return response()->json([
                    'error' => 'Data not found',
                ], 404);
            }

            return new PostResource(true, 'Detail Data lead channel', $data);
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
            $data = lead_channels::findOrFail($id);
            if (!$data) {
                return response()->json([
                    'error' => 'Data not found',
                ], 404);
            }
            $data->update($request->all());

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
            $lead_channel = lead_channels::findOrFail($id);
            $lead_channel->delete();

            return new PostResource(true, 'Data Deleted Successfully', $lead_channel);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}

