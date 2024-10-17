<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setPasswordAttribute($password) {

        $this->attributes['password'] = bcrypt($password);
    }
     public function sendEmail($id)
    {
        // Obtener el usuario por ID
        $user = User::find($id); // Esto debe funcionar correctamente

        // Verificar si el usuario existe
        if ($user) {
            // Preparar el contenido del correo
            $data = [
                'full_name' => $user->full_name ?? $user->name, // Ajusta esto según los campos disponibles
                'message' => 'Este es un mensaje de confirmación.',
            ];

            // Enviar el correo
            Mail::send('emails.template', $data, function($message) use ($user) {
                $message->to($user->email)
                        ->subject('Confirmación de Contratación');
            });

            return response()->json(['success' => 'Correo enviado con éxito']);
        } else {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        
    }
    public function contractUser($id)
    {
        // Buscar al usuario por su ID
        $user = Userprofile::find($id);

        if ($user) {
            // Cambiar el estado del usuario a "contratado"
            $user->status = 'contratado';
            $user->save();  // Guardar los cambios
        }

        // Redirigir a la lista de usuarios contratados con un mensaje de éxito
        return redirect()->route('contracted.users.list')->with('success', 'Usuario contratado exitosamente');
    }

    // Método para mostrar la lista de contratados
    public function contractedUsersList()
    {
        // Obtener todos los usuarios con estado "contratado"
        $contractedUsers = Userprofile::where('status', 'contratado')->get();

        // Retornar la vista con los usuarios contratados
        return view('contracted-users', compact('contractedUsers'));
    }
}