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
            $token =  $user->createToken('nApp')->accessToken;
            return response()->json(['token'=>$token], $this->successStatus);
        }
        else{
            return response()->json(['Email and Password doesnt match'], 401);
        }
    }
    public function loginGetMember(Request $request){
        if(Auth::attempt(['email'=>request('email'),'password'=>request('password')])){
            $user = Auth::user();
            $token =  $user->createToken('nApp')->accessToken;
            $user = $this->getUser();
            return response()->json(['token'=>$token, 'data'=>$user->original], $this->successStatus);
        }
        else{
            return response()->json(['Email and Password doesnt match'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $req['judul'] = "Email Verification";
        $req['nama'] = $request->name;
        $req['email'] = $request->email;
        $req['pesan'] = "Selamat datang di Page Cula.<br>
        Kami dengan senang hati akan membantu Anda dalam membantu project management anda.<br>
        Dengan penggunaan pendekatan metode Agile, Cula memberikan kenyamanan manajemen proyek anda, dan tepat waktu.<br>
        Klik tombol dibawah untuk verifikasi email anda<br><br><br>";
        $req = new Request($req);
        if(!app('App\Http\Controllers\EmailController')->sendEmail($req))
          return response()->json('Email wrong', 401);
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

    public function update(Request $request)
    {
            $user = Auth::user();
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$user->id,
            ]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
            $user->update($request->all());
            $success =  $user;
            return response()->json(['success'=>$success], $this->successStatus);
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
      if($credentials){
        $user['password'] = $input['new_password'];
        $user->save();
        return response()->json(['success'=>'Password has changed']);
      }
      else {
        return response()->json(['error'=>'Unauthorised']);
      }
    }

    public function updatePicture(Request $request, UserPicture $userPicture)
    {
        $picture->update($request->all());
        $success =  $picture;
        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function getUser(){
        $user = Auth::user();
        $picture = $user->userProfile;
        $p = array();
        foreach($picture as $pic){
            $p[] = $pic->picture;
        }
        $user = User::find($user->id);
        $picture = $p[0];
        $user['picture'] = $picture;
        return response()->json(['user'=>$user]);
    }

    public function getProject(){
      $user = Auth::user();

      $project = $user->project;

      return response()->json(['success'=>$project]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    


}
