<?php

namespace App\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Domain\Store\Models\Store;
use App\Infrastructure\Http\Requests\StoreStoreRequest;
use App\Infrastructure\Http\Requests\UpdateStoreRequest;

class StoreController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Store::all());
    }
    
    /**
     * Store a newly created resource in storage.
     * @param StoreStoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreStoreRequest $request)
    {
        $store = Store::query()->create(
            $request->only('name', 'address', 'active')
        );
    
        return response()->json([
            'message' => 'Store successfully created!',
            'data' => $store
        ]);
    }
    
    /**
     * Display the specified resource.
     * @param Store $store
     * @return JsonResponse
     */
    public function show(Store $store)
    {
        return response()->json($store);
    }
    
    /**
     * Update the specified resource in storage.
     * @param UpdateStoreRequest $request
     * @param Store $store
     * @return JsonResponse
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $store->update(
            $request->only('name', 'address', 'active')
        );
    
        return response()->json([
            'message' => 'Store successfully updated!',
            'data' => $store
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     * @param Store $store
     * @return JsonResponse
     */
    public function destroy(Store $store)
    {
        $store->delete();
    
        return response()->json([
            'message' => 'Store successfully deleted!'
        ]);
    }
}
