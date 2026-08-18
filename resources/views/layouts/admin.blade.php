<form action="form-plan" method="post">
    @csrf
    <label for="name">
        Nome:
        <input type="text" name="name" id="name">        
    </label>
    <label for="description">
        Descrição:
        <input type="text" name="description" id="description">
    </label>
    <label for="price">
        Preço:
        <input type="number" name="price" id="price">
    </label>
    <button type="submit">Cadastrar Plano</button>
</form>