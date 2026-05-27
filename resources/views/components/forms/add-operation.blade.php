<form action="{{ route('operation.store') }}" class="container" id="form-operation" method="post">
    @csrf
    <div class="col-12">
        <label for="description">Operação:</label>
        <input type="text" id="description" size="50"  maxlength="255" name="description">
    </div>
</form>