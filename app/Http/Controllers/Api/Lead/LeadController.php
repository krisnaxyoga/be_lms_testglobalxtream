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
    public function index()
    {
        try {
            $data = leads::with('lead_status', 'lead_probability', 'lead_type', 'lead_channel', 'lead_media', 'lead_source')->get();
            //return collection of data as a resource
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

            $data = leads::create($validatedData);

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
            $data = leads::with('lead_status', 'lead_probability', 'lead_type', 'lead_channel', 'lead_media', 'lead_source')->find($id);

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
