<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\DbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $db;
    public function __construct(DbService $db)
    {
        $this->db = $db;
    }

    public function index()
    {
        if (request()->ajax()) {
            $tableName = 'users';
            $query = $this->db->getAll($tableName);
            return DataTables::of($query)
                ->addColumn('password', function ($item) {
                    return $item->password;
                })
                ->addColumn('created_at', function ($item) {
                    return \Carbon\Carbon::parse($item->created_at)->format('d/m/Y');
                })
                ->addColumn('action', function ($item) {
                    $encrypted_id = encrypt($item->id);

                    $btn = view('datatable._action-dropdown', [
                        'model' => $item,
                        'drodown_action' => true,
                        'show_chart' => false,
                        'form_text_url' => 'deleteData(\'' . $item->id . '\')',
                        'dropdown_id' => 'dropdownMenuAction',
                        'show_url_text' => route('users.edit', $encrypted_id),
                        'disable_delete' => false,
                        'form_id' => 'form-' . $encrypted_id,
                        'id_table' => 'tblSafety',
                        'confirm_message' => 'Are you sure want to delete this data?',
                    ])->render();
                    return $btn;
                })
                ->rawColumns(['action', 'created_at', 'password'])
                ->make();
        }
        return view('user.index');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users,email',
                'username' => 'required|unique:users,username|max:128',
                'name' => 'required|string',
                'password' => [
                    'required',
                    'string',
                    'min:5',
                    'max:8',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                ],
            ], [
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters long.',
                'password.regex' => 'Password must contain uppercase letters, lowercase letters, and numbers.',
            ]);
            DB::beginTransaction();

            $tableName = 'users';
            $userData = [
                'username' => strtoupper($validatedData['username']),
                'name' => strtoupper($validatedData['name']),
                'email' => strtoupper($validatedData['email']),
                'password' => Hash::make($validatedData['password']),
            ];
            $this->db->createData($tableName, $userData);

            DB::commit();
            return redirect()->route('users.index')->with('swal_success', __('messages.save_success'));
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
            return back()->with('toast_error', __('messages.save_failed', ['error' => $e->getMessage()]));
        }
    }

    public function edit($encrypted_id)
    {
        $id = decrypt($encrypted_id);
        $tableName = 'users';
        $data = $this->db->getById($tableName, $id);
        return view('user.edit', compact('data', 'encrypted_id'));
    }

    public function update(Request $request, $encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);
            $tableName = 'users';
            $data = $this->db->getById($tableName, $id);

            $validatedData = $request->validate([
                'email' => 'required|email|unique:users,email,' . $id,
                'username' => 'required|unique:users,username,' . $id,
                'name' => 'required|string',
                'current_password' => [
                    'nullable',
                    'required_with:new_password',
                    function ($attribute, $value, $fail) use ($data) {
                        if (!Hash::check($value, $data->password)) {
                            $fail('Password does not match.');
                        }
                    }
                ],
                'new_password' => [
                    'nullable',
                    'required_with:current_password',
                    'max:54',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                ],
            ], [
                'new_password.required' => 'New Password is required.',
                'new_password.min' => 'New Password must be at least 8 characters long.',
                'new_password.regex' => 'New Password must contain uppercase letters, lowercase letters, and numbers.',
            ]);
            DB::beginTransaction();

            $updateData = [
                'username' => strtoupper($validatedData['username']),
                'name' => strtoupper($validatedData['name']),
                'email' => strtoupper($validatedData['email']),
            ];

            if (!empty($validatedData['new_password'])) {
                $updateData['password'] = Hash::make($validatedData['new_password']);
            }

            $this->db->updateData($tableName, $id, $updateData);

            DB::commit();
            return redirect()->route('users.index')->with('swal_success', __('messages.update_success'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withInput()->withErrors($e->validator->errors());
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
            return back()->with('toast_error', __('messages.save_failed', ['error' => $e->getMessage()]));
        }
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $tableName = 'users';
            $data = $this->db->deleteData($tableName, $request->id);
            DB::commit();
            return response()->json($data);
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
