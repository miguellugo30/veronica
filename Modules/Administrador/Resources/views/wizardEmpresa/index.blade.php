<div class="container-fluid">
    <div class="col" style="text-align: center">
        <ul class="list-group list-group-horizontal" >
            @foreach( $steps as $key => $_step )
                @if( $stepsAc['current'] == $_step )
                    <li class="list-group-item active">
                        <strong>{{ \Str::title( $_step ) }}</strong>
                    </li>
                @elseif( $key < $indice)
                    <li class="list-group-item active">
                        <strong>{{ \Str::title( $_step ) }}</strong>
                    </li>
                @else
                    <li class="list-group-item">
                        {{ \Str::title( $_step ) }}
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="col">
        {{ csrf_field() }}
        <form  method="POST" id="formWizardEmpresa">
            @include('administrador::wizardEmpresa.'.$stepsAc['current'], compact('data'))
        </form>
    </div>
    <div class="col"  style="text-align: center">
        <div class="row">
            <div class="col-sm">
                @if ( $stepsAc['prev'] != 'start' )
                    <button type="submit" class="btn btn-success btn-sm prevStep" data-step="{{ $stepsAc['prev'] }}">Anterior</button>
                @endif
            </div>
            <div class="col-sm">
                <span><b>Paso {{ $indice }}/{{ count( $steps ) }}</b></span>
            </div>
            <div class="col-sm">
                @if ( $stepsAc['next'] != 'end' )
                    <button type="submit" class="btn btn-success btn-sm nextStep" data-step="{{ $stepsAc['next'] }}">Siguiente</button>
                @else
                    <button type="submit" class="btn btn-success btn-sm nextStep" data-step="{{ $stepsAc['next'] }}">Finalizar</button>
                @endif
            </div>
        </div>
    </div>
</div>
