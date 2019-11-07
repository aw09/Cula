<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserPicture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
class UserController extends Controller
{
    public $successStatus = 200;
    public function login(Request $request){
        if(Auth::attempt(['email'=>request('email'),'password'=>request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>request('password')], 401);
        }
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        // dd($input);
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['name'] =  $user->name;

        $inputPicture['id_user']=$user->id;
        $inputPicture['picture'] = "dummy";
        $picture = UserPicture::create($inputPicture);
        return response()->json(['success'=>$success['token']]);
    }
    public function changePassword(Request $request){
      $user = Auth::user();
      $validator = Validator::make($request->all(), [
          'old_password' => 'required',
          'new_password' => 'required',
          'confirm_new_password' => 'required|same:new_password',
      ]);
      if ($validator->fails()) {
          return response()->json(['error'=>$validator->errors()], 401);
      }
      $input = $request->all();
      $input['new_password'] = bcrypt($input['new_password']);
      $credentials = Hash::check($input['old_password'], $user['password']);
      //error_log('Some message here.'.$validator->fails());
      if($credentials){
        $user['password'] = $input['new_password'];
        $user->save();
        return response()->json(['success'=>'Password has changed']);
      }
      else {
        return response()->json(['error'=>'Unauthorised']);
      }
    }

    public function getProject(){
      $user = Auth::user();

      $project = $user->project;

      return response()->json([$user->id=>$project]);
    }
}
