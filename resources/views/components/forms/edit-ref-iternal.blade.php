<form action="" method="post" id="form-edit-refIternal">
    @csrf
    @method('PUT')
    <label for="ref-iternal">Referecia Interna:</label>
    <input type="text" class="w-auto m-10 uppercase" name="ref_code" id="ref-iternal" maxlength="20" require>
</form>