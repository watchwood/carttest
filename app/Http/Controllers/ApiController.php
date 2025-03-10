<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Item;
use App\Models\CartItem;


class ApiController extends Controller
{
    public function setItem(Request $request) {
		//a production project would include user authentication here too
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

			//returning a cart collection to the call so Vue can ensure front end accuracy with the database
			$cart = CartItem::with("item")->where("user_id", $request->userId)->get()->toArray();
			return response()->json($cart);
		}
		else {
			//a production project will generally have more detailed error handling
			throw new \Exception;
		}

	}
}
