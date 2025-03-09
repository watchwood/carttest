<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\CartItem;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function index(Request $request) {
		
		//using the hex session ID for a user ID since a user system is out of scope for the project
		$userId = $request->session()->getId();

		//$request->session()->put('initialized', true);
		//create example data on first load
		//dd($request->session()->get('initialized'));
		if ($request->session()->get('initialized') != true){
			$request->session()->put('initialized', true);

			foreach (Item::all() as $item){
				CartItem::create([
					"item_id" => $item->id,
					"user_id" => $userId,
				]);
			}
		}

		//dd($userId);
		//dd($request->session()->all());
		//dd(CartItem::get());
		//dd(CartItem::where("user_id", $userId)->get());

		return view('home',  [
			"items" => CartItem::with("item")->where("user_id", $userId)->get()->toArray(),
			"userId" => $request->session()->getId()
		]);
	}
}
