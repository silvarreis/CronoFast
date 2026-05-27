<form action="{{ route('refIternal.store') }}" method="post" id="add-refiternal">
    @csrf
    <label for="ref-iternal">Referecia Interna:</label>
    <input type="text" class="uppercase" size="24" name="ref_code" id="ref-iternal" maxlength="20" require>
</form>