<?php

namespace App\Http\Controllers\Catalogue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogue;
use App\Http\Resources\Catalogue\CatalogueResource;
use App\Http\Resources\Catalogue\CatalogueResourceCollection;

class CatalogueController extends Controller
{
    public function index()
    {
        return (new CatalogueResourceCollection(Catalogue::paginate()))->response()->setStatusCode(200);
    }

    public function show($id)
    {
        $catalogue = Catalogue::find($id);

        return (new CatalogueResource($catalogue))->response()->setStatusCode(200);
    }

    public function store(Request $request)
    {
        return Catalogue::create($request->all());
    }

    public function update(Request $request, Catalogue $catalogue)
    {
        $catalogue = Catalogue::findOrFail($id);
        $catalogue->update($request->all());

        return $catalogue;
    }

    public function destroy($id)
    {
        $catalogue = Catalogue::findOrFail($id);
        $catalogue->delete();

        return 204;
    }
}
