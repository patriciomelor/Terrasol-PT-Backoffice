@extends('layouts.dash')

@section('content')
    <h1 class="mb-4">Preguntas Frecuentes</h1>

    <!-- Formulario para agregar una nueva FAQ -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Agregar Nueva FAQ</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('faqs.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="question">Pregunta</label>
                    <input type="text" name="question" id="question" class="form-control" placeholder="Pregunta" required>
                    @error('question')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="answer">Respuesta</label>
                    <textarea name="answer" id="answer" class="form-control" placeholder="Respuesta" required></textarea>
                    @error('answer')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Agregar FAQ</button>
            </form>
        </div>
    </div>

    <!-- Lista de F&Q -->
    <div class="card">
        <div class="card-header">
            <h5>Lista de Preguntas Frecuentes</h5>
        </div>
        <div class="card-body">
            <ul id="faq-list" class="list-group">
                @foreach ($faqs as $faq)
                    <li data-id="{{ $faq->id }}" class="faq-item list-group-item mb-3" draggable="true">
                        <strong>{{ $faq->question }}</strong><br>
                        <p>{{ $faq->answer }}</p>
            
                        <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" style="display: inline;"> 
                            @csrf
                            @method('DELETE') 
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </li>
                @endforeach 
            </ul>
                <button id="update-order" class="btn btn-success">Actualizar Orden</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script> 
    <script>
        const faqList = document.getElementById('faq-list');
        new Sortable(faqList, { 
            animation: 150, 
            onUpdate: function (evt/**Event*/){
                const faqsOrder = Array.from(faqList.children).map(item => item.dataset.id);
    
                fetch("{{ route('faqs.updateOrder') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ faqs: faqsOrder })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message); 
                })
                .catch(error => {
                    console.error('Error al actualizar el orden:', error);
                    alert('Error al actualizar el orden.');
                });
            },
        });
    </script>
@endsection
