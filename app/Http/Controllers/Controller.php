<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\CartItem;


class Controller extends BaseController
{

    public function index(Request $request) {
		
		//using the hex session ID for a user ID since a user system is out of scope for the project
		$userId = $request->session()->getId();

		//create example data on first load for a session
		if ($request->session()->get('initialized') != true){
			$request->session()->put('initialized', true);

			foreach (Item::all() as $item){
				CartItem::create([
					"item_id" => $item->id,
					"user_id" => $userId,
				]);
			}
		}

		return view('home',  [
			"items" => CartItem::with("item")->where("user_id", $userId)->get()->toArray(),
			"userId" => $request->session()->getId()
		]);
	}
}
