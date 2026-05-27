<form action="{{ route('employee.store') }}" class="container" id="form-employee" method="post">
    @csrf
    <div class="col-12">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" size="40" maxlength="50">
    </div>
</form>