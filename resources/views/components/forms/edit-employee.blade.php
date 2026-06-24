<form action="" class="container" id="form-edit-employee" method="post">
    @csrf
    @method('PUT')
    <div class="col-12">
        <label for="name">Nome:</label>
        <input type="text" id="name" class="w-sm-100" name="name" size="50" maxlength="50">
    </div>
</form>