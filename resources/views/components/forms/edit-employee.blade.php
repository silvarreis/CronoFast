<form action="{{ request()->fullUrl() }}" class="container" id="form-edit-employee" method="post">
    @csrf
    @method('PUT')
    <div class="col-9">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" size="40" maxlength="50">
    </div>
    <div class="col-3">
        <label for="status">Status:</label>
        <select name="active" id="status">
            <option value="1">Ativo</option>
            <option value="0">Inativo</option>
        </select>
    </div>
</form>