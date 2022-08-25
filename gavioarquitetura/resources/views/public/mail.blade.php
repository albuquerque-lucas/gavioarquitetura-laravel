<x-layout-public title={{$title}}>

    <div class="form-section">
        <p>Entre em contato conosco!</p>
{{--        <?php--}}
{{--        if(isset($_POST['email']) && !empty($_POST['email'])){--}}
{{--        if(mail($to,$subject,$body,$header)){ ?>--}}
{{--        <p class='alert-success form-mensagem-envio'>Mensagem enviada com sucesso!</p>--}}

{{--        <?php--}}
{{--        } else{ ?>--}}
{{--        <p class='alert-danger form-mensagem-envio'>A mensagem não pode ser enviada. :(</p>--}}
{{--        <?php }} ?>--}}


        @if(!empty($message))
            <div class="alert alert-success">
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
