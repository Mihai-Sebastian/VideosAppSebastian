<x-videos-app-layout>
    <div class="container">
        <h1 class="mb-4">Crear Nou Usuari</h1>

        <form action="{{ route('users.manage.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" name="name" id="name" class="form-control" required data-qa="input-name">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required data-qa="input-email">
            </div>

            <div class="form-group">
                <label for="password">Contrasenya:</label>
                <input type="password" name="password" id="password" class="form-control" required data-qa="input-password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirma la Contrasenya:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required data-qa="input-password-confirmation">
            </div>

            <div class="form-group">
                <label for="role">Selecciona un rol:</label>
                <select name="role" id="role" class="form-control" required data-qa="select-role">
                    <option value="" disabled selected>Selecciona un rol</option>
                    @foreach ($roles as $role)

                        <option value="{{ $role->name }}" data-qa="option-role-{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success" data-qa="button-submit">Crear Usuari</button>
            </div>
        </form>
    </div>
</x-videos-app-layout>
