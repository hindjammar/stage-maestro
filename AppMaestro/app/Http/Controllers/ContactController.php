<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'message' => 'required|string',
        ]);

        $mail = new PHPMailer(true);

        try {
            // Configuration du serveur SMTP de Gmail
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = env('MAIL_PORT');

            // Paramètres du courriel
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress('hindjammar5@gmail.com'); // Adresse email de destination

            $mail->isHTML(true);
            $mail->Subject = 'Contact Form Submission';
            $mail->Body    = "Name: {$request->name}<br>Email: {$request->email}<br>Message: {$request->message}";
            $mail->AltBody = "Name: {$request->name}\nEmail: {$request->email}\nMessage: {$request->message}";
            $mail->send();

            return back()->with('success', 'Your message has been sent successfully!');
        } catch (Exception $e) {
            Log::error("Mailer Error: {$mail->ErrorInfo}");


            return back()->with('error', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
        
        