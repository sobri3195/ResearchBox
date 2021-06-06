<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PaymentGateways;
use App\Models\User;
use App\Models\AdminSettings;

class InstallController extends Controller
{
    public function __construct() {
      $this->middleware('role');
    }

    public function install($addon)
    {

      //<-------------- Install --------------->
      if($addon == 'instamojo') {

        $verifyPayment = PaymentGateways::whereName('Instamojo')->first();

        if(!$verifyPayment) {

          // Controller
          $filePathController = 'instamojo-payment/InstamojoController.php';
          $pathController = app_path('Http/Controllers/InstamojoController.php');

          if ( \File::exists($filePathController) ) {
            rename($filePathController, $pathController);
          }//<--- IF FILE EXISTS

          // View
          $filePathView = 'instamojo-payment/instamojo-settings.blade.php';
          $pathView = resource_path('views/admin/instamojo-settings.blade.php');

          if ( \File::exists($filePathView) ) {
            rename($filePathView, $pathView);
          }//<--- IF FILE EXISTS


          file_put_contents(
              'routes/web.php',
              "\nRoute::get('payment/instamojo', 'InstamojoController@show')->name('instamojo');\nRoute::get('webhook/instamojo', 'InstamojoController@webhook');\n",
              FILE_APPEND
          );

          if(Schema::hasTable('payment_gateways')) {
              \DB::table('payment_gateways')->insert(
      				[
      					'name' => 'Instamojo',
      					'type' => 'normal',
      					'enabled' => '0',
      					'fee' => 5.0,
      					'fee_cents' => 0.99,
      					'email' => '',
      					'key' => '',
      					'key_secret' => '',
      					'bank_info' => '',
      					'token' => str_random(150),
      			]
          );
        }

        $indexPath = 'instamojo-payment/index.php';
        unlink($indexPath);

        rmdir('instamojo-payment');

        $getPayment = PaymentGateways::whereName('Instamojo')->firstOrFail();

          return redirect('panel/admin/payments/'.$getPayment->id);
        } else {
          return redirect('/');
        }

    }
  }//<---------------------- End Install

}
