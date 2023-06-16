<x-app-layout>
<div class="mx-auto p-4 sm:p-6 lg:p-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analisis') }}
        </h2>
    </x-slot>

    <!-- Modal Agregar paciente -->
    <div class="modal fade" id="ModalRegistrar" tabindex="-1" aria-labelledby="ModalRegistrarLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ModalRegistrarLabel">Agregar analisis</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <!-- Formulario -->
                                <form action="{{route('analisis.create')}}" method="post">
                                    @csrf
                                    <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="CodigoA" class="form-label">Código</label>
                                        <input type="text" class="form-control" id="CodigoA" name="txtCodigoA">
                                    </div>

                                    <div class="mb-3">
                                        <label for="DenominacionA" class="form-label">Denominación</label>
                                        <input type="text" class="form-control" id="DenominacionA" name="txtDenominacionA">
                                    </div>

                                    <div class="mb-3">
                                        <label for="FechaHoraA" class="form-label">Fecha y Hora</label>
                                        <input type="datetime-local" class="form-control" id="FechaHoraA" name="txtFechaHoraA">
                                    </div>

                                    <div class="mb-3">
                                        <label for="ResultadoA" class="form-label">Resultado</label>
                                        <input type="text" class="form-control" id="ResultadoA" name="txtResultadoA">
                                    </div>
                                
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
    </div>

    @if (session("correcto"))
        <div class="alert alert-success">{{session("correcto")}}</div>
    @endif

    @if (session("incorrecto"))
        <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <script>
        var res=function(){
            var not=confirm("¿Estas seguro de eliminar?");
            return not;
        }
    </script>
    
    <div class="p-5 table table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Denominación</th>
                <th scope="col">Fecha y hora</th>
                <th scope="col">Resultado</th>
                <th><button class="btn" href="" data-bs-toggle="modal" data-bs-target="#ModalRegistrar">Agregar</button>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach ($analisis as $fila)
                <tr>
                    <td>{{ $fila->CodigoA }}</td>
                    <td>{{ $fila->DenominacionA }}</td>
                    <td>{{ $fila->FechaHoraA }}</td>
                    <td>{{ $fila->ResultadoA }}</td>
                    <td>
                        <a class="btn" href="" data-bs-toggle="modal" data-bs-target="#ModalActializar{{ $fila->CodigoA }}">Actualizar</a>
                        <a class="btn" href="{{route('analisis.delete', $fila->CodigoA)}}" onclick="return res()" >Eliminar</a>
                    </td>

                    <!-- Modal Actualizar paciente -->
                    <div class="modal fade" id="ModalActializar{{ $fila->CodigoA }}" tabindex="-1" aria-labelledby="ModalActializarLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ModalActializarLabel">Actualizar Analisis</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <!-- Formulario -->
                            <form action="{{route('analisis.update')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                <div class="mb-3">
                                    <label for="CodigoA" class="form-label">Codigo</label>
                                    <input type="text" class="form-control" id="CodigoA" name="txtCodigoA" value="{{ $fila->CodigoA }}" readonly>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="DenominacionA" class="form-label">Denominación</label>
                                    <textarea class="form-control" id="DenominacionA" name="txtDenominacionA">{{ $fila->DenominacionA }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="FechaHoraA" class="form-label">Fecha y Hora</label>
                                    <input type="datetime-local" class="form-control" id="FechaHoraA" name="txtFechaHoraA" value="{{ $fila->FechaHoraA }}">
                                </div>

                                <div class="mb-3">
                                    <label for="ResultadoA" class="form-label">Resultado</label>
                                    <textarea class="form-control" id="MotivoC" name="txtResultadoA">{{ $fila->ResultadoA }}</textarea>
                                </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</div>
</x-app-layout>