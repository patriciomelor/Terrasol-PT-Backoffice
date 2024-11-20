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
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="mt-3">
        <button id="update-order" class="btn btn-success">Actualizar Orden</button>
    </div>

    <script>
        // Usar JavaScript para permitir el reordenamiento dinámico
        const faqList = document.getElementById('faq-list');
        let faqsOrder = [];

        // Guardar el orden de los FAQ en el inicio
        faqList.addEventListener('dragstart', (e) => {
            faqsOrder = Array.from(faqList.children).map(item => item.dataset.id);
        });

        // Permitir el arrastre sobre los elementos
        faqList.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        // Al dejar el elemento arrastrado
        faqList.addEventListener('drop', (e) => {
            e.preventDefault();
            const draggedFaqId = e.target.closest('.faq-item').dataset.id;
            const index = faqsOrder.indexOf(draggedFaqId);
            faqsOrder.splice(index, 1);
            faqsOrder.push(draggedFaqId);
        });

        // Enviar el nuevo orden al servidor
        document.getElementById('update-order').addEventListener('click', () => {
            fetch("{{ route('faqs.updateOrder') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ faqs: faqsOrder })
            }).then(response => response.json())
              .then(data => {
                  alert(data.message);
              });
        });
    </script>
@endsection
