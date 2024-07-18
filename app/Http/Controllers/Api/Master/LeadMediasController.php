<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\lead_medias;
use App\Http\Resources\PostResource;

class LeadMediasController extends Controller
{
    /**
     * Retrieve all the lead medias.
     */
    public function index()
    {
        try {
            $leadMedias = lead_medias::with('channel')->get();
            return new PostResource(true, 'Lead Media', $leadMedias);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created lead media in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = lead_medias::create([
                'name' => $request->name,
                'channel_id' => $request->channel_id,
            ]);

            return new PostResource(true, 'Lead Media Added Successfully', $data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Retrieve a specific lead media.
     */
    public function show(string $id)
    {
        try {
            $data = lead_medias::findOrFail($id);

            if (!$data) {
                return response()->json([
                    'error' => 'Data not found',
                ], 404);
            }

            return new PostResource(true, 'Lead Media Found', $data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Update a specific lead media in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = lead_medias::findOrFail($id);

            if (!$data) {
                return response()->json([
                    'error' => 'Data not found',
                ], 404);
            }

            $data->update([
                'name' => $request->name,
                'channel_id' => $request->channel_id,
            ]);

            return new PostResource(true, 'Lead Media Updated Successfully', $data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove a specific lead media from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data=lead_medias::destroy($id);

            return new PostResource(true, 'Lead Media Deleted Successfully', $data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}

