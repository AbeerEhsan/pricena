<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable, $type = null)
    {
        // dd($type);

       
        if($type){
            return $userDataTable
                        ->with('type', $type)
                        ->render('users.index');
        }
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        // url()->previous()
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $request->validate([
            'password'=>'required',
            'email'=>'unique:users'
        ]);

        $file = $request->file('img');
        if(!empty($file)){
               $filename = time() . '.' . $file->getClientOriginalExtension();
               request()->img->move(public_path('/uploads/images/users'), $filename);
               $input['img']=$filename;
       }

       $input['password'] = bcrypt($request->password);

        $user = $this->userRepository->create($input);

        Flash::success('تم حفظ معلومات المستخدم بنجاح . ');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('المستخدم غير متوفر . ');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('المستخدم غير متوفر . ');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);
        // image
        $oldimg = $user->img;
        $input = $request->all();
        $file = $request->file('img');
        if(!empty($file)){
               $filename = time() . '.' . $file->getClientOriginalExtension();
               request()->img->move(public_path('/uploads/images/users'), $filename);
               $input['img']=$filename;
       }else{
               $input['img']=$oldimg;
       }
    //    password
       $oldpassword = $user->password;
       if(!empty($request->password)){
           $input['password'] = bcrypt($request->password);
       }else{
           $input['password'] = $oldpassword;
       }
        // email unique
       if($request->email != $user->email){
        $request->validate([
            'email'=>'unique:users'
        ]);
       }
        if (empty($user)) {
            Flash::error('المستخدم غير متوفر . ');

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->update($input, $id);

        Flash::success('تم تعديل بيانات المستخدم بنجاح . ');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('المستخدم غير متوفر . ');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('تم حذف المستخدم بنجاح . ');

        return redirect(route('users.index'));
    }
}
