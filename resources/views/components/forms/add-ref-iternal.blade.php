<form action="{{ route('refIternal.store') }}" class="container" method="post" id="add-refiternal">
    @csrf
    <div class="col-12 m-auto">
        <label for="ref-iternal">Ref. Interna:</label>
        <input type="text" class="uppercase" size="23" name="ref_code" id="ref-iternal" maxlength="20" require>
    </div>
</form>