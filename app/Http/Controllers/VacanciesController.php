<?php

namespace App\Http\Controllers;

use App\Models\Vacancy; // Asegúrate de importar el modelo
use Illuminate\Http\Request;

class VacanciesController extends Controller
{
    // Método para mostrar todas las vacantes (incluyendo la búsqueda)
    public function index(Request $request)
    {
        $query = Vacancy::query(); // Crear una consulta base

        // Verificar si hay un término de búsqueda
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('description', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // Obtener las vacantes (filtradas si se aplica la búsqueda)
        $vacancies = $query->get();

        return view('vacancies.index', compact('vacancies')); // Pasar las vacantes a la vista
    }

    // Método para mostrar las vacantes en showv.blade.php
    public function showV()
    {
        $vacancies = Vacancy::all(); // Obtener todas las vacantes de la base de datos
        return view('vacancies.showv', ['vacancies' => $vacancies]); // Pasar las vacantes a la vista
    }

    // Método para almacenar una nueva vacante
    public function storeV(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'date' => 'required|date',
            'description' => 'required|string|max:100',
        ]);

        // Crear una nueva vacante en la base de datos
        Vacancy::create($validated);

        return redirect()->route('vacancies.index');
    }

    // Método para eliminar una vacante
    public function destroyV($id)
    {
        $vacancy = Vacancy::findOrFail($id); // Obtener la vacante por ID
        $vacancy->delete(); // Eliminar la vacante

        return redirect()->route('vacancies.index');
    }
}
