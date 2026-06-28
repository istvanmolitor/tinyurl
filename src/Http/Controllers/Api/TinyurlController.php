<?php

declare(strict_types=1);

namespace Molitor\Tinyurl\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Molitor\Tinyurl\DataTables\TinyurlDataTable;
use Molitor\Tinyurl\Http\Requests\StoreTinyurlRequest;
use Molitor\Tinyurl\Http\Requests\UpdateTinyurlRequest;
use Molitor\Tinyurl\Http\Resources\TinyurlResource;
use Molitor\Tinyurl\Models\Tinyurl;

class TinyurlController extends Controller
{
    public function index(TinyurlDataTable $dataTable): AnonymousResourceCollection
    {
        return $dataTable->getResponse();
    }

    public function store(StoreTinyurlRequest $request): JsonResponse
    {
        $tinyurl = Tinyurl::create($request->validated());

        return response()->json(['data' => new TinyurlResource($tinyurl)], 201);
    }

    public function show(Tinyurl $tinyurl): JsonResponse
    {
        return response()->json(['data' => new TinyurlResource($tinyurl)]);
    }

    public function update(UpdateTinyurlRequest $request, Tinyurl $tinyurl): JsonResponse
    {
        $tinyurl->update($request->validated());

        return response()->json(['data' => new TinyurlResource($tinyurl)]);
    }

    public function destroy(Tinyurl $tinyurl): JsonResponse
    {
        $tinyurl->delete();

        return response()->json(['message' => 'Törölve.']);
    }
}
