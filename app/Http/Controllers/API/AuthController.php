<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use File;
use App\Models\User;
   
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
   
}