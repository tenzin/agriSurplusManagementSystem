<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\User;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use App\Dzongkhag;
use App\Gewog;

class AccessControlListController extends Controller
{
        public function __construct(Request $request)
        {  
          $this->request = $request;
          $this->middleware('auth');
        }
          
//Role 
        public function indexRole(){

        $roles = Role::all();
        return view('acl.role.index', compact('roles'));
        }

        public function addRole() {

            $permissions = Permission::all();
            return view('acl.role.add',compact('permissions'));
          }

        public function storeRole(Request $request) {
            // $this->validate($request, [
            //   'role' => 'required|unique:roles,role'
            // ]);
            $permissions = $request->permissions;
            $role = new Role;
            $role->role = $request->role_name;
            $role->save();
      
            for($i =0; $i < count($permissions); $i++) {
              $permission=Permission::find($permissions[$i]);
              $role->permissions()->attach($permission);
            }
            return redirect()->route('view-role')->with("success",'Successfully added a new role');
      
          }

          public function editRole($role) {
            $role = Role::find($role);
            $permissions = Permission::all();
            return view('acl.role.edit',compact('role','permissions'));
          }

        public function updateRole(Request $request) {
            $this->validate($request, [
            'role_id' => 'required',
            'role_name' => 'required',
            ]);
            $permissions = $request->permissions;
            $role = Role::find($request->role_id);
            $role->role = $request->role_name;
            $role->save();
            $role->permissions()->detach();
    
            for($i =0; $i < count($permissions); $i++) {
            $permission=Permission::find($permissions[$i]);
            $role->permissions()->attach($permission);
            }
            return redirect()->route('view-role')->with("success",'Successfully updated the role');
        }

        public function destroyRole($id) {
            $role = Role::find($id);
            if($role->users()->count()>0) {
                return redirect()->route('view-role')->with("error",'Cannot delete role. There are users assiged to this role. ');
            } else {
              $role->delete();
              return redirect()->route('view-role')->with("success",'Deleted Role successfully');
            }
          }

//Permission
        public function indexPermission(){
            $permissions = Permission::all();
            return view('acl.permission.index', compact('permissions'));
        }

        public function addPermission() {

            return view('acl.permission.add');
        }

      public function storePermission(Request $request) {
        $this->validate($request, [
          'name' => 'required',
          'label' => 'required'
        ]);
  
        $permission = new Permission;
        $permission->name = $request->name;
        $permission->label = $request->label;
        $permission->save();
        return redirect()->route('view-permission')->with("success",'Successfully added the permission');
      }
      
      public function editPermission($id) {
        $permission = Permission::find($id);
        return view('acl.permission.edit',compact('permission'));
      }

      public function updatePermission(Request $request) {
        $this->validate($request, [
          'id' => 'required',
          'name' => 'required',
          'label' => 'required'
        ]);
  
        $permission = Permission::find($request->id);
        $permission->name = $request->name;
        $permission->label = $request->label;
        $permission->save();
  
        return redirect()->route('view-permission')->with("success",'Successfully updated the permission');
  
      }

      public function destroyPermission($id) {

        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('view-permission')->with("success",'Successfully deleted the permission');
  
      }

  //User management created by Tenzin

    public function user(){
        $users = User::all();
        return view('acl.user.users', compact('users'));
    }
    public function userView($id){

        $user = User::find($id);
        return view('acl.user.userview', compact('user'));
    }

    public function add(){

        $dzongkhags = Dzongkhag::all();
        $roles = Role::all();
        $gewogs = Gewog::all();
        return view('acl.user.adduser',compact('dzongkhags','roles','gewogs'));
    }
      
    public function insert(Request $request){

        $insert = new User;
        $insert->cid= $request->cid;
        $insert->name=$request->name;
        $insert->dzongkhag_id= $request->dzongkhag;
        $insert->gewog_id=$request->gewog;
        $insert->role_id=$request->role;
        $insert->address=$request->address;
        $insert->contact_number=$request->number;
        $insert->isAdmin=$request->admin;
        $insert->isActive=$request->active;
        $insert->isStaff=$request->staff;
        $insert->email=$request->email;
        $insert->password=Hash::make($request->password);
        $insert->longitude=$request->longitude;
        $insert->latitude=$request->latitude;
        $insert->save();
       
        return redirect('system-user')->with('success','User Added successfully');
    
        }

    public function edit($id){

        $users    = User::find($id);
        $dzongkhags = Dzongkhag::all();
        $roles = Role::all();
       $gewogs = Gewog::all();
        // $gewogs = Gewog::where('dzongkhag_id',$users->dzongkhag->id)->get();
        // dd($gewogs);
        return view('acl.user.useredit',compact('users','dzongkhags','roles','gewogs'));
  
    }

    public function update(Request $request){

        $users = User::find($request->id);
        $users->cid= $request->cid;
        $users->name=$request->name;
        $users->dzongkhag_id= $request->dzongkhag;
        $users->gewog_id=$request->gewog;
        $users->role_id=$request->role;
        $users->address=$request->address;
        $users->contact_number=$request->number;
        $users->isAdmin=$request->admin;
        $users->isActive=$request->active;
        $users->isStaff=$request->staff;
        $users->longitude = $request->longitude;
        $users->latitude = $request->latitude;

        // $insert->submitted_by=Auth::user()->id;
        $users->save();
       
        return redirect('system-user')->with('success','Users Infomations Updated successfully');
    
        }
        public function userDelete($id)
        {
            $users = User::find($id);
            $users->delete();
            return back()->with('success', 'Deleted Successfully');
        }

        //password reset
        public function userResetPassword(){
            $users = User::all()->where('role_id','!=', 1);
            return view('acl.user.resetpassword',compact('users'));
        }

        public function passwordReset($id){
            $users = User::find($id);
            return view('acl.user.passupdate', compact('users'));
          }
        
            public function passwordUpdate(Request $request){
             $validatedData = $request->validate([
              'password' => 'required|string|min:5|confirmed',
               ]);
            $users             = User::find($request->id);
            $users->cid        = $request->cid;
            $users->name     = $request->name;
            $users->address     = $request->address;
            $users->email      = $request->email;
            $users->password=Hash::make($request->password);
            $users->save();
            return redirect('user-reset')->with("success","Password Reset Successfully!");
          }

          public function dzongkhag(){

            $id = $this->request->input('dzongkhag');
            $gewog=DB::table('tbl_gewogs')
                ->where('dzongkhag_id', '=', $id)
                ->get();
            return response()->json($gewog);
        }
    
//end
}
