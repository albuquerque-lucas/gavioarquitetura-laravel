<footer class='main-footer'>

    <div class="footer-content">
        <div class="footer-social-info">
            <div class="footer-social-media">
                <a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <a href="https://www.instagram.com/isagavio.arq/" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="footer-adress">
                <p>Rua Ataliba de Barros, 182, São Mateus - Juiz de Fora (Rossi 360 Business, sala 407)</p>
                <p>2021 - Todos os direitos reservados.</p>
            </div>

        </div>
    </div>
    <div class="footer-content">
        <div class="footer-form">
            <strong>Entre em contato conosco!</strong>
            <form action="{{route('mail.store')}}" method="POST">
                @csrf
                <input type="text" name='name' placeholder='Seu nome'>

                <input type="text" name='email' placeholder='Seu e-mail'>

                <input type="text" name='subject' placeholder='Digite um assunto'>

                <textarea name="message" id="message-text" placeholder='Mensagem'></textarea>
                <button type='submit' name='submit'>Enviar</button>
            </form>

        </div>
    </div>


</footer>
