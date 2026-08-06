
<form action="" id="add-time-part" class="container" method="post">
    <div class="col-6 col-sm-6">
        <label for="internal-reference">Referencia:
            <select id="internal-reference" class="ref w-sm-100" name="internal_reference_id" require>
                <option value="0"selected>...</option>
                @foreach($internalReferences as $id => $refName)
                    <option value="{{$id}}">{{$refName}}</option>
                @endforeach
            </select>
        </label>
    </div>
    <div class="col-6 col-sm-6">
        <label for="center-work">Grupo:
            <input type="text" id="center-work" maxlength="26" class="center-work w-sm-100" name="center_work" require />
        </label>
    </div>
    <div class="col-9 col-sm-12">
        <label for="operation">Operação:
            <select id="operation" class="oper w-sm-100" name="operation_id" require>
                <option value="0"selected>...</option>
                @foreach($operations as $id => $description)
                    <option value="{{$id}}">{{$description}}</option>
                @endforeach
            </select>
        </label>
    </div>
    <div class="col-3 col-sm-6">
        <label for="num-repetition">Repetição:
            <input type="number" id="num-repetition" value="1" class="rep " name="num_repetition" require/>
        </label>
    </div>

    <div class="col-3 col-sm-4">
        <label class="flw-right" for="production-pace">Ritmo:
            <input type="number" id="production-pace" class="pace"  value="100" name="production_pace" require/>
        </label>
    </div>
    <div class="col-6 col-sm-7">
        <label for="operator">Opr:</label>
        <select  id="operator" class="employee" name="employee_id" require>
            <option value="1"selected>...</option>
            @foreach($employees as $id => $name)
                <option value="{{$id}}">{{$name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3 col-sm-5">
        <label for="margin-value">Tolerância:</label>
        <input type="number" id="margin-value" class="margin"value="20" name="margin_value" require/>
    </div>
    <div class="col-12 col-sm-12">
        <label for="machine">Maquina:</label>
        <select  id="machine" class="machine" name="machine_id" require>
            <option value="1"selected>...</option>
            @foreach($machines as $id => $name)
                <option value="{{$id}}">{{$name}}</option>
            @endforeach
        </select>
    </div>
</form>