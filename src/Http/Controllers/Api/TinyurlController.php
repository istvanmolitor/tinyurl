<?php

declare(strict_types=1);

namespace Molitor\Tinyurl\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Molitor\Tinyurl\DataTables\TinyurlDataTable;
use Molitor\Tinyurl\Http\Requests\StoreTinyurlRequest;
use Molitor\Tinyurl\Http\Requests\UpdateTinyurlRequest;
use Molitor\Tinyurl\Http\Resources\TinyurlResource;
use Molitor\Tinyurl\Models\Tinyurl;

class TinyurlController extends Controller
{
    public function quickCreate(Request $request): JsonResponse
    {
        $request->validate(['url' => 'required|string|url|max:2048']);

        $url = $request->input('url');
        $tinyurl = Tinyurl::where('url', $url)->first();

        if (! $tinyurl) {
            do {
                $slug = strtolower(Str::random(6));
            } while (Tinyurl::where('slug', $slug)->exists());

            $tinyurl = Tinyurl::create(['url' => $url, 'slug' => $slug]);
        }

        return response()->json(['data' => new TinyurlResource($tinyurl)], 201);
    }

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
