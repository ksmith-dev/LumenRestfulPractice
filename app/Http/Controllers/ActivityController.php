<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller as BaseController;

class ActivityController extends BaseController
{

    public function activities()
    {
        return response()->json(Activity::all());
    }

    public function activity($id)
    {
        return response()->json(Activity::find($id));
    }

    public function create(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required|unique:activity',
                'code' => 'required|max:10',
                'icon' => 'required|url',
                'description' => 'max:200'
            ]);
        } catch (ValidationException $e) {
            return view('exception', ['exception' => $e]);
        }

        $Activity = Activity::create($request->all());

        return response()->json($Activity, 201);
    }

    public function update($id, Request $request)
    {
        $Activity = Activity::findOrFail($id);
        $Activity->update($request->all());

        return response()->json($Activity, 200);
    }

    public function delete($id)
    {
        Activity::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }


}
