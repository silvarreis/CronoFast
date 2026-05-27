<form action="" class="container" id="form-edit-operation" method="post">
    @csrf
    @method('PUT')
    <div class="col-12">
        <label for="description">Operação:</label>
        <input type="text" id="description" size="255" maxlength="255" name="description">
    </div>
</form>