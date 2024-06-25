<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Récupérer les données du formulaire
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        // Création d'une nouvelle instance de PHPMailer
        $mail = new PHPMailer();

        // Configuration de l'envoi via SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'votre@gmail.com'; // Votre adresse Gmail
        $mail->Password = 'votre_mot_de_passe'; // Votre mot de passe Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Configuration de l'expéditeur et du destinataire
        $mail->setFrom($email, $name);
        $mail->addAddress('destinataire@example.com', 'Destinataire');

        // Configuration du sujet et du corps de l'email
        $mail->Subject = 'Nouveau message de contact';
        $mail->Body = "Nom: $name\nEmail: $email\nMessage: $message";

        // Envoi de l'email
        if ($mail->send()) {
            return redirect()->back()->with('success', 'Votre message a été envoyé avec succès.');
        } else {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'envoi de votre message. Veuillez réessayer.');
        }
    }
}
