<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Email;
use App\Jobs\SendEmailJob;
use App\Mail\UserEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class EmailController extends Controller
{
    public function queuedEmail(Request $request)
    {
        $success = false;
        $data = '';
        $error = '';
        DB::beginTransaction();
        try {
            $email = Email::create([
                'email' => $request->email,
                'subject' => $request->subject,
                'addressee' => $request->addressee,
                'message' => $request->message,
                'user_id' => 1 // Auth::id()
            ]);
            dispatch(new SendEmailJob($email)); //Pasando el email a la cola de ejecusiones
            DB::commit();

            $success = true;
        } catch (\Throwable $th) {
            $success = false;
            $error = $th->getMessage();
            DB::rollBack();
        }
        if ($success) {
            return [
                'status' => true,
                'payload' => $data
            ];
        } else {
            return [
                'status' => false,
                'error' => $error
            ];
        }
    }

    public function getEmails()
    {
        return Email::all();
    }
}
