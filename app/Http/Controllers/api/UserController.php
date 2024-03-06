<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $contact = $request->get('contact');

        $permission = $request->get('permission');

        $normalValidation = Validator::make($request->all(), [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'contact.email' => ['required', 'string'],
            'permission' => ['required', 'in:ADMIN,USER']
        ]);

        $adminValidation = Validator::make($request->all(), [
            'contact.phone' => ['required', 'string']
        ]);

        if ($normalValidation->fails()) {
            return response('Validation failed, invalid form data.' . $normalValidation->errors(), 400);
        }
        if ($permission === 'ADMIN' && $adminValidation->fails()) {
            return response('Validation failed, invalid form data.' . $adminValidation->errors(), 400);
        }

        return response('Your username is: ' . $username . ', your password is: ' . $password . ', and your phone is: ' . $contact['phone'] . ' and your email is: ' . $contact['email']);
    }
}
