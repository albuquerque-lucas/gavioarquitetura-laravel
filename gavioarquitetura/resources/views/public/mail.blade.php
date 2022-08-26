<x-layout-public title={{$title}}>

    <div class="form-section">
        <p>Entre em contato conosco!</p>

        @if(!empty($message))
            <div class="alert alert-success w-50 text-center">
                {{ $message }}
            </div>
        @endif

        <form action="{{route('mail.store')}}" method="post">
            @csrf
            <input type="text" name='name' placeholder='Seu nome'>
            <input type="text" name='email' placeholder='Seu e-mail'>
            <input type="text" name='subject' placeholder='Digite um assunto'>
            <textarea name="message" id="message" placeholder='Mensagem'></textarea>
            <button type='submit' name='submit'>Enviar</button>
        </form>
    </div>

</x-layout-public>
