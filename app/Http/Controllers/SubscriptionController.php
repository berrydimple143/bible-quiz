<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Subscription;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('allowed');
    }
    public function index() {
        $subscriptions = Subscription::where('id', '!=', null)->orderBy('name', 'asc')->get();
        return FunctionController::viewPage(Auth::user(), $subscriptions, 'SUBSCRIPTIONS TABLE', '', 'admin.subscriptions.subscriptions', 'menu7', '');
    }
    public function create() {
        return FunctionController::viewPage(Auth::user(), '', 'SUBSCRIPTION CREATOR', '', 'admin.subscriptions.subscription_add', 'menu7', ['btn' => 'SAVE']);
    }
    public function store(Request $request) {
        $v = $request->validate([
            'name' => 'required|string|max:20',
            'price' => 'required|string',
        ]);
        $data = [
			'name' => $request->input('name', ''),
			'price' => $request->input('price', ''),
			'article' => $request->input('article', ''),
			'image' => $request->input('image', ''),
		];				
		$p = Subscription::create($data);
		return redirect()->route('subscriptions');
    }
    public function edit($id) {
        $subscription = Subscription::where('id', $id)->first();
        return FunctionController::viewPage(Auth::user(), $subscription, 'SUBSCRIPTION EDITOR', '', 'admin.subscriptions.subscription_edit', 'menu7', ['btn' => 'SAVE CHANGES']);
    }
    public function update(Request $request, $id) {
        $v = $request->validate([
            'name' => 'required|string|max:20',
            'price' => 'required|string',
        ]);
        $data = [
			'name' => $request->input('name', ''),
			'price' => $request->input('price', ''),
			'article' => $request->input('article', ''),
			'image' => $request->input('image', ''),
		];
        $p = Subscription::where('id', $id)->update($data);
        return redirect()->route('subscriptions');
    }
    public function delete($id) {
        $p = Subscription::find($id);
        return FunctionController::viewPage(Auth::user(), $p, 'SUBSCRIPTION REMOVER', '', 'admin.subscriptions.subscription_delete', 'menu7', '');
    }
    public function destroy($id) {
        $ph = Subscription::destroy($id);
        return redirect()->route('subscriptions');
    }
}
