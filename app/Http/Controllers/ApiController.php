<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Item;
use App\Models\CartItem;


class ApiController extends Controller
{
    public function setItem(Request $request) {
		$request->validate([
			'id' => 'integer|required',
			'userId' => 'string|required',
			'amount' => 'integer|required',
		]);

		$item = CartItem::where("user_id", $request->userId)->where("id", $request->id)->first();

		if ($item){
			if ($request->amount>0) {
				$item->update(['amount' => $request->amount]);
			}
			else {
				$item->delete();
			}
			$cart = CartItem::with("item")->where("user_id", $request->userId)->get()->toArray();
			return response()->json($cart);
		}
		else {
			throw new \Exception;
		}

	}
}
