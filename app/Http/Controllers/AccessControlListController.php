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

class AccessControlListController extends Controller
{
        public function __construct()
        {
            $this->middleware('auth');
        }
        public function userprofile(){
            
            return view('ACL.userprofile');
        }
       
//Users
        public function indexUser()
        {
            
            $users = User::all();
            return view('acl.user.index', compact('users'));
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
            return redirect()->route('indexRole')->with("success",'Successfully added a new role');
      
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
            return redirect()->route('indexRole')->with("success",'Successfully updated the role');
        }

        public function destroyRole($id) {
            $role = Role::find($id);
            if($role->users()->count()>0) {
                return redirect()->route('indexRole')->with("error",'Cannot delete role. There are users assiged to this role. ');
            } else {
              $role->delete();
              return redirect()->route('indexRole')->with("success",'Deleted Role successfully');
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
        return redirect()->route('indexPermission')->with("success",'Successfully added the permission');
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
  
        return redirect()->route('indexPermission')->with("success",'Successfully updated the permission');
  
      }

      public function destroyPermission($id) {

        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('indexPermission')->with("success",'Successfully deleted the permission');
  
      }

    public function user(){
        $users = User::all();
        return view('ACL.users', compact('users'));
    }
    public function add(){
        $dzongkhags = Dzongkhag::all();
        $roles = Role::all();
        $gewogs = Gewog::all();
        return view('ACL.adduser',compact('dzongkhags','roles','gewogs'));
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
        $insert->email=$request->email;
         $insert->password=Hash::make($request->password);
        // $insert->submitted_by=Auth::user()->id;
        $insert->save();
       
        return redirect()->route('e_govform.view')->with('success','Added successfully');
    
        }


    public function userView(){
        $users = User::all();
        return view('ACL.userview', compact('users'));
    }
}
