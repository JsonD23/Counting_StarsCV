<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        // Guardar la entrevista en la sesión (o en la base de datos)
        $interviews = session('interviews', []);
        $interviews[] = [
            'date' => $validated['date'],
            'description' => $validated['description'],
            'id' => count($interviews) + 1 // Generar un ID simple
        ];
        session(['interviews' => $interviews]);

        return redirect()->route('calendar.index');
    }

    public function destroy($id)
    {
        $interviews = session('interviews', []);
        $interviews = array_filter($interviews, fn($interview) => $interview['id'] != $id);
        session(['interviews' => array_values($interviews)]);

        return redirect()->route('calendar.index');
    }
    

}
