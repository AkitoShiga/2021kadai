<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use App\Models\RegisterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
  /**
   *  Send Register Link Email
   *  送られてきた内容をテーブルに保存して認証メールを送信
   *  @param Request $request
   *  @return RegisterUser
   *
   */
   public function sendMail(Request $request)
   {
       $this->validator($request->all())->validate();
       $token = $this->createToken();
       RegisterUser::destroy($request->email);
       $passwordReset = new RegisterUser($request->all());
       $passwordReset->token = $token;
       $passwordReset->password = Hash::make($request->password);
       $passwordReset->save();
       $this->sendVerificationMail($passwordReset->email, $token);
       return $passwordReset;
   }

   /**
    * validator
    * @param array $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * create activation token
     * トークンを作成する
     * @return string
     */
    private function createToken()
    {
        return hash_hmac('sha256', Str::random(40), config('app.key'));
    }

    /**
     * send verification mail
     * メール送信
     * @param string $email
     * @param string $token
     * @return void
     */
    private function sendVerificationMail($email, $token)
    {
        Mail::to($email)->send(new VerificationMail($token));
    }
}
