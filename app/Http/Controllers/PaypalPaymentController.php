<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paypalpayment;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Subscription;
use Carbon\Carbon;
use Redirect;
use App\Mail\UserSubscribed;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\Crypt;
use Hash;

class PaypalPaymentController extends Controller
{
    public function index() {
        $payments = Paypalpayment::getAll(['count' => 1, 'start_index' => 0], Paypalpayment::apiContext());
        return response()->json([$payments->toArray()], 200);
    }
    public function show($payment_id) {
       $payment = Paypalpayment::getById($payment_id, Paypalpayment::apiContext());
       return response()->json([$payment->toArray()], 200);
    }
    public function payment_failed($ftype) {
        $type = "";
        if($ftype != "" or $ftype != null) {
            $arr = explode("-", $ftype);
            $type = $arr[0];
            $id = $arr[1];
            if($id != "" or $id != null) {
                $usr = User::where('id', $id)->delete();
            }
        }
        return FunctionController::viewFrontPage('site.errors.payment_failed', '', 'Payment failed', 'Payment failed', '404error_page', $type, '');
    }
    public function payment_successful($crypto) {
        $str = Crypt::decryptString($crypto);
        $arr = explode("|@@|", $str);
        $id = $arr[0];
        $sub = $arr[1];
        $type = $arr[2];
        $price = $arr[3];
        $user = User::where('id', $id)->first();
        Mail::to($user)->send(new UserSubscribed($user));
        $now = Carbon::now();
        $activated = Carbon::now();
        $subs = (int)$sub;
        if($subs <= 1) {
            $expired = $now->addMonth();
        } else {
            $expired = $now->addMonths($subs);
        }
        $usr = User::where('id', $id)->update(['subscription' => $subs, 'membership' => $type, 'status' => 'active', 'activated_at' => $activated, 'expired_at' => $expired]);
        return FunctionController::viewFrontPage('site.payment_successful', '', 'Subscription Successful', 'Subscription Successful', '404error_page', '', '');
    }
    public function registration_successful($id) {
        $usr = User::where('id', $id)->first();
        $subs = Subscription::where('name', $usr->membership)->first();
        return FunctionController::viewFrontPage('site.registration_successful', '', 'Free Registration Successful', 'Free Registration Successful', '404error_page', $subs, '');
    }
    public function registration_failed($firstname) {
        return FunctionController::viewFrontPage('site.errors.registration_failed', '', 'Free Registration Failed', 'Free Registration Failed', '404error_page', $firstname, '');
    }
    public function paynow(Request $request) {
        $userid = $request->input('userid');
        $stype = $request->input('stype');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $password = Hash::make($request->input('password'));
        $email = $request->input('email');
        $duration = $request->input('duration');
        $payment = $request->input('payment');
        $now = Carbon::now();
        $trial = $now->addMonth();
        if($stype == "free") {
            if(!Auth::check()) {
                $v = $request->validate([
                    'firstname' => ['required', 'string', 'max:60'],
                    'lastname' => ['required', 'string', 'max:60'],
                    'email' => ['required', 'string', 'email', 'max:60', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
                $usr = User::create([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'password' => $password,
                    'membership' => 'regular',
                    'status' => 'active',
                    'ip' => \Request::ip(),
                    'activated_at' => Carbon::now(),
                    'expired_at' => $trial,
                    'subscription' => 0,
                ]);
                return redirect()->route('registration.successful', ['id' => $usr->id]);
            } else {
                $u = Auth::user();
                return redirect()->route('registration.failed', ['firstname' => $u->firstname]);
            }
        } else {
            if(Auth::check()) {
                $id = Auth::user()->id;
            } else {
                try {
                  $user = User::where('firstname', $firstname)->where('lastname', $lastname)->where('email', $email)->firstOrFail();
                } catch (ModelNotFoundException $ex) {
                  $user = "Not Found";
                }
                if($user != "Not Found") {
                    $id = $user->id;
                } else {
                    $usr = User::create([
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'email' => $email,
                        'password' => $password,
                        'membership' => 'regular',
                        'status' => 'active',
                        'ip' => \Request::ip(),
                        'activated_at' => Carbon::now(),
                        'expired_at' => $trial,
                        'subscription' => 0,
                    ]);
                    $id = $usr->id;
                }
            }
            if($payment == "paypal") {
                return $this->paywithPaypal($id, $duration, $stype);
            } else if($payment == "creditcard") {
                $dt = Carbon::now();
                $start = (int)$dt->year;
                $xyr = [];
                for($x = $start; $x < $start + 15; $x++) {
                    $xyr[] = $x;    
                }
                return view('site.creditcard', [
                    'title' => 'Credit Card Form', 
                    'page' => 'Credit Card Form', 
                    'id' => $id,
                    'duration' => $duration, 
                    'xyr' => $xyr, 
                    'stype' => $stype, 
                    'firstname' => $firstname, 
                    'lastname' => $lastname, 
                    'categories' => FunctionController::getCategories(10),
                    'allcategories' => FunctionController::allCategories(),
                    'populars' => FunctionController::getPopular(5),
                    'comments' => FunctionController::getComments(5),
                    'bclass' => 'shop_grid_page'
                ]);
            }
        }
    }
    public function processCreditCard(Request $request) {
        $id = $request->input('userid');
        $duration = $request->input('duration');
        $stype = $request->input('stype');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $ctype = $request->input('ctype');
        $cardno = $request->input('cardno');
        $xmonth = $request->input('xmonth');
        $xyear = $request->input('xyear');
        $cvv = $request->input('cvv');
        return $this->paywithCreditCard($id, $duration, $stype, $firstname, $lastname, $ctype, $cardno, $xmonth, $xyear, $cvv);
    }
    public function paywithCreditCard($id, $sub, $type, $firstname, $lastname, $ctype, $cardno, $xmonth, $xyear, $cvv) {
        $card = Paypalpayment::creditCard();
        $card->setType($ctype)->setNumber($cardno)->setExpireMonth($xmonth)->setExpireYear($xyear)->setCvv2($cvv)->setFirstName($firstname)->setLastName($lastname);
        $fi = Paypalpayment::fundingInstrument();
        $fi->setCreditCard($card);
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("credit_card")->setFundingInstruments([$fi]);
        $strsub = (string)$sub;
        $desc = "OnlineStorehouse " . ucfirst($type) . " Subscription for " . $strsub . " month(s)";
        $prc = (float)($this->getPrice($sub, $type));
        $item1 = Paypalpayment::item();
        $item1->setName('OnlineStorehouse payment for subscription')->setDescription($desc)->setCurrency('USD')->setQuantity(1)->setPrice($prc);
        $itemList = Paypalpayment::itemList();
        $itemList->setItems([$item1]);
        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")->setTotal($prc);
        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)->setItemList($itemList)->setDescription("OnlineStorehouse Subscription Payment")->setInvoiceNumber(uniqid());
        $payment = Paypalpayment::payment();
        $payment->setIntent("sale")->setPayer($payer)->setTransactions([$transaction]);
        $ftype = $type . '-'. $id;
        try {
            $payment->create(Paypalpayment::apiContext());
        } catch (\Exception $e) {
            return Redirect::route('payment.failed', ['ftype' => $ftype]);
        }
        if($payment->state == "approved") {
            $str = $id . "|@@|" . $sub . "|@@|" . $type . "|@@|" . $prc;
            $crypto = Crypt::encryptString($str);
            return Redirect::route('payment.success', ['crypto' => $crypto]);
        }
        return Redirect::route('payment.failed', ['ftype' => $ftype]);
    }
    public function paywithPaypal($id, $sub, $type) {
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("paypal");
        $strsub = (string)$sub;
        $desc = "OnlineStorehouse " . ucfirst($type) . " Subscription for " . $strsub . " month(s)";
        $prc = (float)($this->getPrice($sub, $type));
        $item1 = Paypalpayment::item();
        $item1->setName('OnlineStorehouse payment for subscription')->setDescription($desc)->setCurrency('USD')->setQuantity(1)->setPrice($prc);
        $itemList = Paypalpayment::itemList();
        $itemList->setItems([$item1]);
        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")->setTotal($prc);
        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)->setItemList($itemList)->setDescription("OnlineStorehouse Subscription Payment")->setInvoiceNumber(uniqid());
        $redirectUrls = Paypalpayment::redirectUrls();
        $str = $id . "|@@|" . $sub . "|@@|" . $type . "|@@|" . $prc;
        $crypto = Crypt::encryptString($str);
        $myurl = "/payments/success/". $crypto;
        $ftype = $type . '-'. $id; 
        $furl = "/payments/fails/" . $ftype;
        $redirectUrls->setReturnUrl(url($myurl))->setCancelUrl(url($furl));
        $payment = Paypalpayment::payment();
        $payment->setIntent("sale")->setPayer($payer)->setRedirectUrls($redirectUrls)->setTransactions([$transaction]);
        try {
            $payment->create(Paypalpayment::apiContext());
        } catch (\Exception $e) {
            return Redirect::route('payment.failed', ['ftype' => $ftype]);
        }
        $redirect_url = $payment->getApprovalLink();
        if(isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }
        return Redirect::route('payment.failed', ['ftype' => $ftype]);
    }
    private function getPrice($subs, $types) {
        $intsub = (int)$subs;
        try {
          $mem = Subscription::where('name', $types)->firstOrFail();
          $p = (float)$mem->price;
        } catch (ModelNotFoundException $ex) {
          $p = "0.00";
        }
        $base = (float)$p;
        return bcmul($base, $intsub, 2);
    }
}
