<form action="{{ route('machine.store') }}" class="container" id="form-machine" method="post">
    @csrf
    <div class="col-12 m-auto">
        <label for="name-machine">Nome da Maquina:</label>
        <input type="text" id="name-machine" class="text-center" size="6"  maxlength="6" name="name" require>
    </div>
</form>