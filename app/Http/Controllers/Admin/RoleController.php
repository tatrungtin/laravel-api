<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Routing\Router;
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
        $q = trim(urldecode($request->input('q')));
        $query = Role::latest();
        if ($q) {
            $query->where('name', 'LIKE', "%" . $q . "%");
        }
        $items = $query->paginate(config("constants.ITEM_PER_PAGE"));
        return view('admin.roles.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->getPermissions();
        return view('admin.roles.form', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try {
            Role::create([
                'name' => $request->input("name"),
                'permissions' => $request->input("permissions"),
            ]);
        } catch (\Exception $e) {
            flash($e->getMessage(), 'danger');
            return back()->withInput();
        }

        flash('Add role successfully!', 'success');
        return redirect(route('roles.index'));
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
        return view('admin.roles.form', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->name = $request->name;
        $role->permissions = $request->permissions;
        $role->save();
        flash('Update role successfully!', 'success');
        return back();
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
            flash('You can\'t delete Super Admin!', 'danger');
            return back();
        }
        $role->delete();
        flash('Delete role successfully!', 'success');
        return redirect(route('roles.index'));
    }
}
