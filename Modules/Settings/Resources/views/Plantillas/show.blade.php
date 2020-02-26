<table class="table table-bordered table-sm">
    <caption>Campos de plantilla</caption>
    <thead>
        <tr class="table-active">
            @foreach ($plantilla->Plantillas_campos->sortBy('orden') as $campo)
                <td>
                    @foreach ($campos as $v)
                        @if ($v->id == $campo->fk_campos_plantilla_empresa_fk_cat_campos_plantilla_id)
                            {{ $v->nombre }}
                        @endif
                    @endforeach
                </td>
            @endforeach
        </tr>
    </thead>
</table>
