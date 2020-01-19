<?php

namespace App\Http\Controllers\Catalogue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogue;
use App\Http\Resources\Catalogue\CatalogueResource;
use App\Http\Resources\Catalogue\CatalogueResourceCollection;
use Illuminate\Validation\Rule;
use Validator;

class CatalogueController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Catalogue::class);

        return (new CatalogueResourceCollection(Catalogue::paginate()))->response()->setStatusCode(200);
    }

    public function show($id)
    {
        $catalogue = Catalogue::find($id);

        $this->authorize('view', $catalogue);

        if (is_null($catalogue)) {
            return response()->json([
                'success' => 'false',
                'message' => 'Catalogue does not exist.'
            ], 404);
        }

        return (new CatalogueResource($catalogue))->response()->setStatusCode(200);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Catalogue::class);

        $input = $request->all();

        $validator = Validator::make($input, [
            'catalogue_code' => 'required|unique:catalogues|max:16',
            'description' => 'required|max:32',
            'details' => 'max:255',
            'status' => [
                'required',
                'max:1',
                Rule::in(['A', 'I']),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $catalogue = Catalogue::create($input);

        return (new CatalogueResource($catalogue))->response()->setStatusCode(201);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'catalogue_code' => 'required|max:16',
            'description' => 'required|max:32',
            'details' => 'max:255',
            'status' => [
                'required',
                'max:1',
                Rule::in(['A', 'I']),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $catalogue = Catalogue::find($id);

        $this->authorize('update', $catalogue);

        if (is_null($catalogue)) {
            return response()->json([
                'success' => 'false',
                'message' => 'Catalogue does not exist.'
            ], 404);
        }

        $input['catalogue_code'] = $id;
        $catalogue->update($input);

        return (new CatalogueResource($catalogue))->response()->setStatusCode(201);
    }

    public function destroy($id)
    {
        $catalogue = Catalogue::find($id);

        $this->authorize('delete', $catalogue);

        if (is_null($catalogue)) {
            return response()->json([
                'success' => 'false',
                'message' => 'Catalogue does not exist.'
            ], 404);
        }

        $catalogue->delete();

        return response()->json([
            'success' => 'true',
            'message' => 'Catalogue was deleted.'
        ], 200);
    }
}
