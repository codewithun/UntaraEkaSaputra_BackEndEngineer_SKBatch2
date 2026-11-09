<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicantRequest;
use App\Http\Requests\UpdateApplicantStageRequest;
use App\Models\Applicant;
use Illuminate\Http\JsonResponse;

class ApplicantController extends Controller
{
    /**
     * List all applicants.
     */
    public function index(): JsonResponse
    {
        $applicants = Applicant::latest()->get();

        return response()->json([
            'message' => 'Applicants retrieved successfully.',
            'data' => $applicants,
        ], 200);
    }

    /**
     * Create a new applicant.
     */
    public function store(StoreApplicantRequest $request): JsonResponse
    {
        $applicant = Applicant::create($request->validated())->refresh();

        return response()->json([
            'message' => 'Applicant created successfully.',
            'data' => $applicant,
        ], 201);
    }

    /**
     * Update applicant stage.
     */
    public function updateStage(
        UpdateApplicantStageRequest $request,
        string $id
    ): JsonResponse {
        $applicant = Applicant::find($id);

        if (!$applicant) {
            return response()->json([
                'message' => 'Applicant not found.',
            ], 404);
        }

        $applicant->update([
            'stage' => $request->validated('stage'),
        ]);

        return response()->json([
            'message' => 'Applicant stage updated successfully.',
            'data' => $applicant->fresh(),
        ], 200);
    }
}
