@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container mt-5">
    <h1 class="text-5xl text-center pt-24 font-bold text-blue-600">COUNTING STARS</h1>
    <p class="text-center mt-4 text-lg text-gray-700">
        Bienvenido al Generador de CV's Counting Stars, 
        donde puedes crear y gestionar tu currículum de manera sencilla y efectiva.
        ¡Comienza tu camino hacia el éxito profesional hoy mismo!
    </p>
    
 
    <div class="chat-container mt-5" id="chat-section">
        <div class="chat-box border rounded p-3 shadow-lg">
            <div class="chat-messages" id="chat-messages" style="height: 300px; overflow-y: auto;">
                <div class="message bot-message">Hola, aquí tienes algunas preguntas comunes:</div>
                <div class="message bot-message">1. ¿Cómo puedo empezar a crear un CV?</div>
                <div class="message bot-message">2. ¿Qué información debo incluir en mi CV?</div>
                <div class="message bot-message">3. ¿Tienes ejemplos de CV's?</div>
                <div class="message bot-message">4. ¿Cómo puedo mejorar mi CV?</div>
                <div class="message bot-message">5. ¿Qué formato es mejor para un CV?</div>
            </div>
            <div class="input-group mt-3">
                <select id="question-select" class="form-control">
                    <option value="">Selecciona una pregunta...</option>
                    <option value="¿Cómo puedo empezar a crear un CV?">¿Cómo puedo empezar a crear un CV?</option>
                    <option value="¿Qué información debo incluir en mi CV?">¿Qué información debo incluir en mi CV?</option>
                    <option value="¿Tienes ejemplos de CV's?">¿Tienes ejemplos de CV's?</option>
                    <option value="¿Cómo puedo mejorar mi CV?">¿Cómo puedo mejorar mi CV?</option>
                    <option value="¿Qué formato es mejor para un CV?">¿Qué formato es mejor para un CV?</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-primary" id="send-button">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const answers = {
        "¿Cómo puedo empezar a crear un CV?": "Para empezar a crear un CV, primero debes definir tu objetivo profesional y recopilar toda la información relevante sobre tu experiencia laboral y educación.",
        "¿Qué información debo incluir en mi CV?": "Debes incluir tu información de contacto, un resumen profesional, tu experiencia laboral, educación y habilidades relevantes.",
        "¿Tienes ejemplos de CV's?": "Sí, puedes encontrar ejemplos de CV's en nuestro sitio web en la sección de plantillas.",
        "¿Cómo puedo mejorar mi CV?": "Puedes mejorar tu CV revisando la gramática, utilizando palabras clave relevantes y personalizándolo para cada solicitud de trabajo.",
        "¿Qué formato es mejor para un CV?": "El formato más común es el cronológico, pero también puedes considerar un formato funcional o combinado dependiendo de tu experiencia."
    };

    document.getElementById('send-button').addEventListener('click', function() {
        const selectedQuestion = document.getElementById('question-select').value;
        
        if (selectedQuestion) {
            addMessage('user-message', selectedQuestion);
            const answer = answers[selectedQuestion];
            setTimeout(() => {
                addMessage('bot-message', answer);
            }, 1000);
        }
    });

    function addMessage(type, message) {
        const chatMessages = document.getElementById('chat-messages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}-message`;
        messageDiv.textContent = message;
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight; // Desplazar hacia abajo
    }
</script>

<style>
    .chat-container {
        max-width: 800px;
        margin: 0 auto;
    }
    .chat-box {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }
    .message {
        margin: 5px 0;
        font-weight: bold; 
        font-size: 1.1rem; 
    }
    .user-message {
        text-align: right;
        color: #fff; /* Color de texto */
        background-color: #007bff; /* Fondo claro */
        padding: 10px;
        border-radius: 5px;
    }
    .bot-message {
        text-align: left;
        color: #333; /* Color de texto */
        background-color: #e3f2fd; /* Fondo claro */
        padding: 10px;
        border-radius: 5px;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        color: white;
        font-size: 1rem;
        border-radius: 5px;
        text-decoration: none;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        cursor: pointer;
    }
</style>
@endsection
