<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use File;
use App\Models\User;
use Mail;
use App\Mail\NotifyMail;
   
class AuthController extends BaseController
{

    public function signin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $authUser = Auth::user(); 
            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken; 
            $success['name'] =  $authUser->name;
   
            return $this->sendResponse($success, 'User signed in');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $user->attachRole('user');
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User created successfully.');
    }
    public function update_profile(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); exit('poikkk');
        $user = User::where('id', auth()->user()->id)->first();
        if ($user) {
            if (isset($request->name))
                $user->name = $request->name;
            if (isset($request->phone))
                $user->phone = $request->phone;
            if($request->hasFile('image')){ 
                $destinationPath = 'images/profile_image';
                File::delete($destinationPath.'/'.$user->product_thumbnail);
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images/profile_image'), $imageName);
            }
            if(isset($imageName))
                $user->image = $imageName;
            $user->save();
            return $this->sendResponse($user, 'User Updated Successfully.');
        }else{
            return $this->sendError('Error', 'No User Found.');
        }
    }
    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), $code=200);       
        }else{
            // dd('test');
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $randomNumber = random_int(1000, 9999);
                $details = [
                    'title' => 'Mail from Call Your Support',
                    'code' => $randomNumber
                ];
                Mail::to($user->email)->send(new NotifyMail($details));
                // \Mail::to($user->email)->send(new \App\Mail\MyTestMail($details));
                User::where('id', $user->id)->update(array('otp' => $randomNumber));
                return $this->sendResponse(['forgotPassword' => $user], 'forgotPassword email send successfully');
            }else{
                $message = 'No User found against this email';
                $error = 'No User found against this email';
                return $this->sendError($message, ['error'=>$error], $code=200);
            }
        }
    }
    public function verify_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric',
            'email' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), $code=200);       
        }
        $user = User::where('email', '=', $request->email)
                        ->where('otp', '=', (int)$request->otp)
                        ->first();
        if ($user === null) {
            $message = 'Your OTP is incorrect please resend email';
            return $this->sendError($message, ['error'=>$message], $code=200);
        }else{
            return $this->sendResponse(['verifyOtp' => $user], 'Your OTP verify successfully');
        }
    }
    public function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), $code=200);       
        }
        $user = User::where('email', $request->email)->update(array('password' => bcrypt($request->password)));
        if ($user) {
            return $this->sendResponse(['resetPassword' => $user], 'Your password reset successfully');
        }else{
            $message = 'Something went wrong';
            return $this->sendError($message, ['error'=>$message], $code=200);
        }
    }
    
    public function sendmail()
    {
        $details = [
                    'title' => 'Mail from Call Your Support',
                    'code' => '1234'
                ];
        Mail::to('hafizadil431@gmail.com')->send(new NotifyMail($details));
 
        if (Mail::failures()) {
            return $this->sendError('Error', 'Sorry! Please try again latter.');
        }else{
            return $this->sendResponse('success', 'Great! Successfully send in your mail.');
        }
    }
}