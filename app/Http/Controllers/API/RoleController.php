<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Router;
use App\Role;
use App\Http\Responses\APIResponse;
use Validator;

class RoleController extends Controller
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    public function getPermissions()
    {
        $actionName = [];
        foreach ($this->router->getRoutes() as $value) {
            $action = $value->getName();
            $actionArray = explode('.', $action);
            $key = $actionArray[0];
            if ($action && !isNoneAuthorizeAction($action)) {
                if (count($actionArray) > 1){
                    $actionName[$key][] = $actionArray[1];
                }
                else
                    $actionName[$action][] = null;
            }
        }
        return $actionName;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = trim(urldecode($request->input('keyword')));
        $limit = (int)$request->input('limit',config("constants.ITEM_PER_PAGE"));
        $query = Role::latest();
        if ($keyword) {
            $query->where('name', 'LIKE', "%" . $keyword . "%");
        }
        $roles = $query->paginate($limit);
        return APIResponse::success(compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->getPermissions();
        return APIResponse::success(compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $role = Role::create([
            'name' => $request->input("name"),
            'permissions' => $request->input("permissions"),
        ]);
        return APIResponse::success(compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = $this->getPermissions();
        return APIResponse::success(compact('permissions','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $role->name = $request->input("name");
        $role->permissions = $request->input("permissions");
        $role->save();
        return APIResponse::success(compact('role'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        if ($role->id == config("constants.SUPERADMIN_ROLE_ID")) {
            return APIResponse::fail([],'You can\'t delete Super Admin!');
        }
        $role->delete();
        return APIResponse::success([],'Delete role successfully!');
    }
}
