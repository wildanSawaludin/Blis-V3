<?php
namespace App\Http\Controllers;
/**
 * (c) @iLabAfrica
 * BLIS			 - a port of the Basic Laboratory Information System (BLIS) to Laravel.
 * Team Lead	 - Emmanuel Kweyu.
 * Devs			 - Brian Maiyo|Ann Chemutai|Winnie Mbaka|Ken Mutuma|Anthony Ereng
 */

use Illuminate\Http\Request;
use App\Models\Practitioner;

class PractitionerController extends Controller
{
	public function index()
	{
		$practitioner = Practitioner::orderBy('id', 'ASC')->paginate(20);
		return response()->json($practitioner);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$rules = array(
			"active" => 'required',
			"created_by" => 'required',
			"name" => 'required',
			"gender_id" => 'required',
		);

		$validator = \Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return response()->json($validator);
		} else {
			$practitioner = new Practitioner;
			$practitioner->active = $request->input('active');
			$practitioner->created_by = $request->input('created_by');
			$practitioner->name = $request->input('name');
			$practitioner->telecom = $request->input('telecom');
			$practitioner->address = $request->input('address');
			$practitioner->gender_id = $request->input('gender_id');
			$practitioner->birth_date = $request->input('birth_date');
			$practitioner->photo = $request->input('photo');
			$practitioner->qualification = $request->input('qualification');

			try{
				$practitioner->save();
				return response()->json($practitioner);
			}
			catch (\Illuminate\Database\QueryException $e){
				return response()->json(array('status' => 'error', 'message' => $e->getMessage()));
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id){
		$practitioner=Practitioner::findOrFail($id);
		return response()->json($practitioner);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  request
	 * @param  int  id
	 * @return \Illuminate\Http\Response
	 */	public function update(Request $request, $id)
	{
		$rules = array(
			"active" => 'required',
			"created_by" => 'required',
			"name" => 'required',
			"gender_id" => 'required',
		);

		$validator = \Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			 return response()->json($validator,422);
		} else {
			$practitioner = Practitioner::findOrFail($id);
			$practitioner->active = $request->input('active');
			$practitioner->created_by = $request->input('created_by');
			$practitioner->name = $request->input('name');
			$practitioner->telecom = $request->input('telecom');
			$practitioner->address = $request->input('address');
			$practitioner->gender_id = $request->input('gender_id');
			$practitioner->birth_date = $request->input('birth_date');
			$practitioner->photo = $request->input('photo');
			$practitioner->qualification = $request->input('qualification');

			try{
				$practitioner->save();
				return response()->json($practitioner);
			}
			catch (\Illuminate\Database\QueryException $e){
				return response()->json(array('status' => 'error', 'message' => $e->getMessage()));
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id){
		try{
			$practitioner = Practitioner::findOrFail($id);
			$practitioner->delete();
			return response()->json($practitioner,200);
		}
		catch (\Illuminate\Database\QueryException $e){
			return response()->json(array('status' => 'error', 'message' => $e->getMessage()));
		}
	}
}