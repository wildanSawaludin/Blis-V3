<?php
namespace App\Http\Controllers;
/**
 * (c) @iLabAfrica
 * BLIS      - a port of the Basic Laboratory Information System (BLIS) to Laravel.
 * Team Lead     - Emmanuel Kweyu.
 * Devs      - Brian Maiyo|Ann Chemutai|Winnie Mbaka|Ken Mutuma.
 * More Devs     - Derrick Rono|Anthony Ereng|Emmanuel Kitsao.
 */

use Illuminate\Http\Request;
use App\Models\TestTypeCategory;

class TestTypeCategoryController extends Controller
{
	public function index()
	{
		$testTypeCategory=TestTypeCategory::orderBy('id', 'ASC')->paginate(20);
		return response()->json($testTypeCategory);
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
			"name" => 'required',

		);
		$validator = \Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return response()->json($validator);
		} else {
			$testTypeCategory= new TestTypeCategory;
			$testTypeCategory->code = $request->input('code');
			$testTypeCategory->name = $request->input('name');

			try{
				$testTypeCategory->save();
				return response()->json($testTypeCategory);
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
		$testTypeCategory=TestTypeCategory::findOrFail($id);
		return response()->json($testTypeCategory);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  request
	 * @param  int  id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$rules=array(
			"name" => 'required',

		);
		$validator = \Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return response()->json($validator,422);
		} else {
			$testTypeCategory=TestTypeCategory::findOrFail($id);
			$testTypeCategory->code = $request->input('code');
			$testTypeCategory->name = $request->input('name');

			try{
				$testTypeCategory->save();
				return response()->json($testTypeCategory);
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
			$testTypeCategory=TestTypeCategory::findOrFail($id);
			$testTypeCategory->delete();
			return response()->json($testTypeCategory,200);
		}
		catch (\Illuminate\Database\QueryException $e){
			return response()->json(array('status' => 'error', 'message' => $e->getMessage()));
		}
	}
}