<x-layout title="">
    <style>

    </style>
    <form action="" method="post" class="w-50 position-absolute top-50 start-50 translate-middle">
        <h1>Login Admin</h1>
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <button class="btn btn-primary mt-3 mb-3">
            Entrar
        </button>


        <a href="{{route('users.create')}}" class="btn btn-secondary mt-3 mb-3">
            Registrar
        </a>
    </form>

</x-layout>
