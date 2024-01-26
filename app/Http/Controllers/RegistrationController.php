<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\View\View;


class RegistrationController extends Controller
{
    /**
     * register event.
     *
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {  
            $errorMessages = $validator->errors()->all();
            $errorMessageText = implode("\n", $errorMessages);
            $data =[
                'success' => false,
                'message' => $errorMessageText
            ];
            return response()->json($data);
        }

        try {
            $event = Event::where('slug', $request->slug)->first();

            $registration = Registration::where('email', $request->email)->first();

            if ($registration) {
                $data =[
                    'success' => false,
                    'message' => 'Already Registered with this Email'
                ];
                
                return response()->json($data);
            }

            if ($event) {
                $data = $request->all();

                $data['event_id'] = $event->id;

                $registration = Registration::create($data);
    
                $data =[
                    'success' => true,
                    'message' => 'Registered Successfully'
                ];
    
                return response()->json($data);
            }else{
                $data =[
                    'success' => false,
                    'message' => 'This event is expired'
                ];
                
                return response()->json($data);
            }

        } catch (\Exception $e) {
            $data =[
                'success' => false,
                'message' => 'Server Error'
            ];
            
            return response()->json($data);
        }
    } //end function register

    /**
     * Display a listing of the resource.
     *
     */
    public function index():View
    {
        try {

        } catch (\Exception $e) {
            return abort(500);
        }
        $registrations = Registration::latest()->get();

        return view('dashboard.registrations.list', compact('registrations'));
    } //end function index
} //end class RegistrationController
