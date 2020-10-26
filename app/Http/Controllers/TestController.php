<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Model
use App\Model\LeftItem;
use App\Model\RightItem;

// Validation Request
use App\Http\Requests\CreateItemRequest;

class TestController extends Controller
{
    public function index()
    {
        $leftItems = LeftItem::all();
        $rightItems = RightItem::all();
        // return view('welcome', ['leftItems' => $leftItems, 'rightItems' => $rightItems]);
        return view('welcome', compact('leftItems', 'rightItems'));
    }

    public function addItem(CreateItemRequest $request)
    {

        $leftItem = new LeftItem();

        $leftItem->name = $request->name;
        $leftItem->save();

        return redirect('/');
    }

    public function moveToLeft(Request $request)
    {
        $id = $request->name;

        $rightItem = RightItem::find($id);

        $leftItem = new LeftItem();
        $leftItem->name = $rightItem->name;
        $leftItem->save();

        RightItem::destroy($id);

        return 'success';
    }

    public function moveToRight(Request $request)
    {
        $id = $request->name;

        $leftItem = LeftItem::find($id);

        $rightItem = new RightItem();
        $rightItem->name = $leftItem->name;
        $rightItem->save();

        LeftItem::destroy($id);

        return 'success';
    }
}
