<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvaluation;
use App\Http\Resources\EvaluationResource;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    protected $repository;

    public function __construct(Evaluation $model)
    {
        $this->repository = $model;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($company)
    {
        $evaluations = $this->repository->where('company', $company)->get();

        return EvaluationResource::collection($evaluations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvaluation $request, $company)
    {
        $evaluation = $this->repository->create($request->validated());

        return new EvaluationResource($evaluation);
    }
}
