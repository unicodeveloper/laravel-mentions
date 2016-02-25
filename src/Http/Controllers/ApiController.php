<?php

namespace Unicodeveloper\Mention\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $type
     * @param Request $request
     * @return Response
     */
    public function index($type, Request $request)
    {
        try {
            $resultColumns = [];
            $query = $request->get('q');
            $column = $request->get('c');

            $model = app()->make(config('mentions.' . $type));

            $records = $model->where($column, 'LIKE', "%$query%")
                             ->get([$column]);

            foreach ($records as $record) {
                $resultColumns[] = $record->$column;
            }

            return response()->json($resultColumns);
        } catch (\ReflectionException $e) {
            return response()->json('Not Found', 404);
        }
    }
}
